<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sesi;
use App\Models\FieldKategori;
use App\Models\MetodePembayaran;
use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\DataPeserta;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    /**
     * Menampilkan halaman pendaftaran
     */
    public function index()
    {
        $events = Event::with('sesi')
            ->where('status_event', 'publikasi')
            ->orderBy('tanggal_event', 'asc')
            ->get();

        $metodePembayaran = MetodePembayaran::where('status', 'aktif')->get();

        return view('public.pendaftaranPeserta_public', compact('events', 'metodePembayaran'));
    }

    /**
     * Get sesi berdasarkan event
     */
    public function getSesi($idEvent)
    {
        $sesi = Sesi::with(['kategori'])
            ->where('id_event', $idEvent)
            ->where('status_sesi', 'buka')
            ->get()
            ->map(function($item) {
                return [
                    'id_sesi' => $item->id_sesi,
                    'nama_sesi' => $item->nama_sesi,
                    'id_kategori' => $item->id_kategori,
                    'nama_kategori' => $item->kategori->nama_kategori ?? '-',
                    'kuota_maksimal' => $item->kuota_maksimal,
                    'waktu_mulai' => $item->waktu_mulai,
                    'waktu_selesai' => $item->waktu_selesai,
                ];
            });

        return response()->json($sesi);
    }

    /**
     * Get fields berdasarkan kategori (dari sesi yang dipilih)
     */
    public function getFields($idKategori)
    {
        $fields = FieldKategori::where('id_kategori', $idKategori)
            ->orderBy('id_field')
            ->get()
            ->map(function($item) {
                return [
                    'id_field' => $item->id_field,
                    'nama_field' => $item->nama_field,
                    'tipe_field' => $item->tipe_field,
                    'wajib' => (bool)$item->wajib,
                ];
            });

        return response()->json($fields);
    }

    /**
     * Proses pendaftaran
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_sesi' => 'required|exists:sesi,id_sesi',
            'fields' => 'required|array',
            'metode_pembayaran' => 'nullable|exists:metode_pembayaran,id_metode'
        ]);

        try {
            DB::beginTransaction();

            // Get sesi dan event
            $sesi = Sesi::with('event')->findOrFail($request->id_sesi);
            $event = $sesi->event;

            // Cek kuota
            $jumlahPeserta = Pendaftaran::where('id_sesi', $request->id_sesi)
                ->where('status_pendaftaran', '!=', 'dibatalkan')
                ->count();

            if ($jumlahPeserta >= $sesi->kuota_maksimal) {
                return redirect()->back()
                    ->with('error', 'Maaf, kuota sesi ini sudah penuh!');
            }

            // Generate kode pendaftaran
            $kodePendaftaran = 'REG-' . strtoupper(Str::random(8));

            // 1. Buat pendaftaran
            $pendaftaran = Pendaftaran::create([
                'id_sesi' => $request->id_sesi,
                'kode_pendaftaran' => $kodePendaftaran,
                'waktu_daftar' => now(),
                'status_pendaftaran' => $event->jenis_event == 'berbayar' ? 'menunggu_pembayaran' : 'terdaftar'
            ]);

            // 2. Buat peserta
            $peserta = Peserta::create([
                'id_pendaftaran' => $pendaftaran->id_pendaftaran
            ]);

            // 3. Simpan data peserta dari fields
            foreach ($request->fields as $idField => $nilai) {
                DataPeserta::create([
                    'id_peserta' => $peserta->id_peserta,
                    'id_field' => $idField,
                    'nilai' => $nilai
                ]);
            }

            // 4. Jika event berbayar, buat pembayaran
            if ($event->jenis_event == 'berbayar') {
                $kodePembayaran = 'PAY-' . strtoupper(Str::random(12));

                $pembayaran = Pembayaran::create([
                    'id_pendaftaran' => $pendaftaran->id_pendaftaran,
                    'id_metode' => $request->metode_pembayaran,
                    'kode_pembayaran' => $kodePembayaran,
                    'nominal' => $event->biaya,
                    'status_pembayaran' => 'pending'
                ]);

                // Ambil metode pembayaran
                $metode = MetodePembayaran::find($request->metode_pembayaran);

                DB::commit();

                // Tampilkan halaman pembayaran dengan kode dan QR simulasi
                return view('public.pembayaran', [
                    'kodePembayaran' => $kodePembayaran,
                    'nominal' => $event->biaya,
                    'metode' => $metode,
                    'namaEvent' => $event->nama_event,
                    'idPembayaran' => $pembayaran->id_pembayaran
                ]);
            }

            DB::commit();

            return redirect()->route('pendaftaran.success')
                ->with('success', 'Pendaftaran berhasil! Kode: ' . $kodePendaftaran);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal mendaftar: ' . $e->getMessage());
        }
    }

    /**
     * Konfirmasi pembayaran (simulasi)
     */
    public function confirmPayment(Request $request)
    {
        $idPembayaran = $request->id_pembayaran;
        
        $pembayaran = Pembayaran::with('pendaftaran')->findOrFail($idPembayaran);
        
        // Update status pembayaran
        $pembayaran->update([
            'status_pembayaran' => 'berhasil',
            'tanggal_pembayaran' => now()
        ]);
        
        // Update status pendaftaran
        if ($pembayaran->pendaftaran) {
            $pembayaran->pendaftaran->update([
                'status_pendaftaran' => 'terdaftar'
            ]);
        }
        
        return redirect()->route('pendaftaran.success')
            ->with('success', 'Pembayaran berhasil! Pendaftaran Anda telah dikonfirmasi.');
    }

    /**
     * Halaman sukses pendaftaran
     */
    public function success()
    {
        return view('public.pendaftaran_success');
    }
    
}