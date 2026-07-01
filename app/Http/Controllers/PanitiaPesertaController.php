<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PanitiaPesertaController extends Controller
{
    public function index()
    {
        $idPanitia = session('id_panitia');

        $peserta = DB::table('pendaftaran')

            ->join('peserta', 'pendaftaran.id_pendaftaran', '=', 'peserta.id_pendaftaran')

            ->join('data_peserta as nim', function ($join) {
                $join->on('peserta.id_peserta', '=', 'nim.id_peserta')
                     ->where('nim.id_field', 1);
            })

            ->join('data_peserta as nama', function ($join) {
                $join->on('peserta.id_peserta', '=', 'nama.id_peserta')
                     ->where('nama.id_field', 2);
            })

            ->join('sesi', 'pendaftaran.id_sesi', '=', 'sesi.id_sesi')
            ->join('event', 'sesi.id_event', '=', 'event.id_event')

            ->where('event.created_by', $idPanitia)

            ->select(
                'nim.nilai as nim',
                'nama.nilai as nama',
                'event.nama_event',
                'sesi.nama_sesi',
                'pendaftaran.status_pendaftaran'
            )

            ->orderBy('nama.nilai')

            ->get();

        return view('panitia.dataPeserta_panitia', compact('peserta'));
    }
}