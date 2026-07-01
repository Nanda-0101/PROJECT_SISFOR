<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Panitia;
use App\Models\KategoriPeserta;  // <-- TAMBAHKAN INI
use App\Models\Sesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminEventController extends Controller
{
    /**
     * Menampilkan form buat event
     */
    public function create()
    {
        $panitia = Panitia::where('status', 'aktif')
            ->orderBy('nama_panitia')
            ->get();

        $kategori = KategoriPeserta::orderBy('nama_kategori')->get();

        return view('admin.buatEvent_admin', compact('panitia', 'kategori'));
    }

    /**
     * Menyimpan event dan sesi
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'tanggal_event' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'jenis_event' => 'required|in:gratis,berbayar',
            'biaya' => 'required|numeric|min:0',
            'created_by' => 'required|exists:panitia,id_panitia',
            // Validasi sesi
            'sesi_nama' => 'required|array|min:1',
            'sesi_nama.*' => 'required|string|max:100',
            'sesi_kategori' => 'required|array',
            'sesi_kategori.*' => 'required|exists:kategori_peserta,id_kategori',
            'sesi_mulai' => 'required|array',
            'sesi_mulai.*' => 'required|date',
            'sesi_selesai' => 'required|array',
            'sesi_selesai.*' => 'required|date|after:sesi_mulai.*',
            'sesi_kuota' => 'required|array',
            'sesi_kuota.*' => 'required|integer|min:1'
        ]);

        try {
            DB::beginTransaction();

            // 1. Buat Event dengan status publikasi
            $event = Event::create([
                'nama_event' => $request->nama_event,
                'deskripsi' => $request->deskripsi,
                'tanggal_event' => $request->tanggal_event,
                'lokasi' => $request->lokasi,
                'jenis_event' => $request->jenis_event,
                'biaya' => $request->biaya ?? 0,
                'status_event' => 'publikasi', // Otomatis publikasi
                'created_by' => $request->created_by,
                'updated_by' => $request->created_by
            ]);

            // 2. Buat Sesi untuk event
            foreach ($request->sesi_nama as $key => $namaSesi) {
                Sesi::create([
                    'id_event' => $event->id_event,
                    'id_kategori' => $request->sesi_kategori[$key],
                    'nama_sesi' => $namaSesi,
                    'waktu_mulai' => $request->sesi_mulai[$key],
                    'waktu_selesai' => $request->sesi_selesai[$key],
                    'kuota_maksimal' => $request->sesi_kuota[$key],
                    'status_sesi' => 'buka',
                    'created_by' => $request->created_by,
                    'updated_by' => $request->created_by
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.kelola.event')
                ->with('success', 'Event "' . $event->nama_event . '" berhasil dibuat dengan ' . count($request->sesi_nama) . ' sesi!');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal membuat event: ' . $e->getMessage());
        }
    }
}