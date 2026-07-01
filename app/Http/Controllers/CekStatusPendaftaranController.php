<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CekStatusPendaftaranController extends Controller
{
    public function index()
    {
        $events = DB::table('event')
            ->where('status_event', 'publikasi')
            ->orderBy('tanggal_event')
            ->get();

        return view('public.cekStatusPendaftaran_public', compact('events'));
    }

    public function cek(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'id_event' => 'required|exists:event,id_event'
        ]);

        $pendaftaran = DB::table('pendaftaran')
            ->join('sesi', 'pendaftaran.id_sesi', '=', 'sesi.id_sesi')
            ->join('event', 'sesi.id_event', '=', 'event.id_event')
            ->join('kategori_peserta', 'sesi.id_kategori', '=', 'kategori_peserta.id_kategori')
            ->join('peserta', 'pendaftaran.id_pendaftaran', '=', 'peserta.id_pendaftaran')

            ->leftJoin('data_peserta as nama', function ($join) {
                $join->on('peserta.id_peserta', '=', 'nama.id_peserta')
                    ->where('nama.id_field', 2);
            })

            ->leftJoin('data_peserta as email', function ($join) {
                $join->on('peserta.id_peserta', '=', 'email.id_peserta')
                    ->where('email.id_field', 3);
            })

            ->leftJoin('data_peserta as wa', function ($join) {
                $join->on('peserta.id_peserta', '=', 'wa.id_peserta')
                    ->where('wa.id_field', 4);
            })

            ->leftJoin('data_peserta as nim', function ($join) {
                $join->on('peserta.id_peserta', '=', 'nim.id_peserta')
                    ->where('nim.id_field', 1);
            })

            ->where('email.nilai', $request->email)
            ->where('event.id_event', $request->id_event)

            ->select(
                'pendaftaran.kode_pendaftaran',
                'pendaftaran.status_pendaftaran',
                'pendaftaran.waktu_daftar',
                'event.nama_event',
                'event.tanggal_event',
                'sesi.nama_sesi',
                'sesi.waktu_mulai',
                'sesi.waktu_selesai',
                'kategori_peserta.nama_kategori',
                DB::raw('nama.nilai as nama'),
                DB::raw('email.nilai as email'),
                DB::raw('wa.nilai as whatsapp'),
                DB::raw('nim.nilai as nim')
            )
            ->first();

        if (!$pendaftaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        // Format status
        $statusLabels = [
            'terdaftar' => 'DITERIMA',
            'menunggu_verifikasi' => 'MENUNGGU VERIFIKASI',
            'menunggu_pembayaran' => 'MENUNGGU PEMBAYARAN',
            'dibatalkan' => 'DIBATALKAN'
        ];

        $statusColors = [
            'terdaftar' => 'diterima',
            'menunggu_verifikasi' => 'pending',
            'menunggu_pembayaran' => 'pending',
            'dibatalkan' => 'ditolak'
        ];

        $pendaftaran->status_label = $statusLabels[$pendaftaran->status_pendaftaran] ?? $pendaftaran->status_pendaftaran;
        $pendaftaran->status_color = $statusColors[$pendaftaran->status_pendaftaran] ?? 'pending';

        return response()->json([
            'success' => true,
            'data' => $pendaftaran
        ]);
    }
}