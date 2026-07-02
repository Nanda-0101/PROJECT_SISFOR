<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanitiaTutupSesiController extends Controller
{
    public function index(Request $request)
    {
        $idPanitia = session('id_panitia');
        
        if (!$idPanitia) {
            return redirect()->route('panitia.login');
        }

        $selectedEvent = $request->query('event_id');

        $events = DB::table('event')
            ->where('created_by', $idPanitia)
            ->orderBy('nama_event')
            ->get();

        $sesis = DB::table('sesi')
            ->join('event', 'sesi.id_event', '=', 'event.id_event')
            ->leftJoin('pendaftaran', 'sesi.id_sesi', '=', 'pendaftaran.id_sesi')
            ->leftJoin('peserta', 'pendaftaran.id_pendaftaran', '=', 'peserta.id_pendaftaran')
            ->where('event.created_by', $idPanitia)
            ->when($selectedEvent, function ($query, $selectedEvent) {
                return $query->where('event.id_event', $selectedEvent);
            })
            ->select(
                'sesi.id_sesi',
                'sesi.nama_sesi',
                'sesi.waktu_mulai',
                'sesi.waktu_selesai',
                'sesi.kuota_maksimal',
                'sesi.status_sesi',
                'event.id_event',
                'event.nama_event',
                DB::raw('COUNT(peserta.id_peserta) as jumlah_peserta')
            )
            ->groupBy(
                'sesi.id_sesi',
                'sesi.nama_sesi',
                'sesi.waktu_mulai',
                'sesi.waktu_selesai',
                'sesi.kuota_maksimal',
                'sesi.status_sesi',
                'event.id_event',
                'event.nama_event'
            )
            ->orderBy('sesi.waktu_mulai')
            ->get();

        return view('panitia.tutupSesi_panitia', compact('sesis', 'events', 'selectedEvent'));
    }
    public function tutupSesi($id)
    {
        $idPanitia = session('id_panitia');

        $cek = DB::table('sesi')
            ->join('event', 'sesi.id_event', '=', 'event.id_event')
            ->where('event.created_by', $idPanitia)
            ->where('sesi.id_sesi', $id)
            ->first();

        if (!$cek) {
            return back()->with('error', 'Sesi tidak ditemukan.');
        }

        DB::table('sesi')
            ->where('id_sesi', $id)
            ->update([
                'status_sesi' => 'tutup'
            ]);

        return back()->with('success', 'Sesi berhasil ditutup.');
    }
}