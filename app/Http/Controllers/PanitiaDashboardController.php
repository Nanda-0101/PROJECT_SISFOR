<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\DB;

class PanitiaDashboardController extends Controller
{
    public function index()
    {
        $idPanitia = session('id_panitia');

        /*
        |--------------------------------------------------------------------------
        | Card Dashboard
        |--------------------------------------------------------------------------
        */

        $totalEvent = Event::where('created_by', $idPanitia)->count();

        $totalPeserta = DB::table('event')
            ->join('sesi', 'event.id_event', '=', 'sesi.id_event')
            ->join('pendaftaran', 'sesi.id_sesi', '=', 'pendaftaran.id_sesi')
            ->join('peserta', 'pendaftaran.id_pendaftaran', '=', 'peserta.id_pendaftaran')
            ->where('event.created_by', $idPanitia)
            ->count();

        $sesiAktif = DB::table('sesi')
            ->join('event', 'sesi.id_event', '=', 'event.id_event')
            ->where('event.created_by', $idPanitia)
            ->where('sesi.status_sesi', 'buka')
            ->count();

        $sesiPenuh = DB::table('sesi')
            ->join('event', 'sesi.id_event', '=', 'event.id_event')
            ->leftJoin('pendaftaran', 'sesi.id_sesi', '=', 'pendaftaran.id_sesi')
            ->where('event.created_by', $idPanitia)
            ->select(
                'sesi.id_sesi',
                'sesi.kuota_maksimal',
                DB::raw('COUNT(pendaftaran.id_pendaftaran) as total')
            )
            ->groupBy('sesi.id_sesi', 'sesi.kuota_maksimal')
            ->havingRaw('COUNT(pendaftaran.id_pendaftaran) >= sesi.kuota_maksimal')
            ->get()
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Grafik
        |--------------------------------------------------------------------------
        */

        $grafik = DB::table('event')
            ->leftJoin('sesi', 'event.id_event', '=', 'sesi.id_event')
            ->leftJoin('pendaftaran', 'sesi.id_sesi', '=', 'pendaftaran.id_sesi')
            ->where('event.created_by', $idPanitia)
            ->select(
                'event.nama_event',
                DB::raw('COUNT(pendaftaran.id_pendaftaran) as total')
            )
            ->groupBy(
                'event.id_event',
                'event.nama_event'
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Rekap Event
        |--------------------------------------------------------------------------
        */

        $rekapEvent = DB::table('event')
            ->leftJoin('sesi', 'event.id_event', '=', 'sesi.id_event')
            ->leftJoin('pendaftaran', 'sesi.id_sesi', '=', 'pendaftaran.id_sesi')
            ->where('event.created_by', $idPanitia)
            ->select(
                'event.nama_event',
                'event.tanggal_event',
                DB::raw('SUM(sesi.kuota_maksimal) as kuota'),
                DB::raw('COUNT(pendaftaran.id_pendaftaran) as peserta')
            )
            ->groupBy(
                'event.id_event',
                'event.nama_event',
                'event.tanggal_event'
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Pendaftaran Terbaru
        |--------------------------------------------------------------------------
        */

        $pendaftaranTerbaru = DB::table('pendaftaran')

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

            ->orderByDesc('pendaftaran.id_pendaftaran')

            ->limit(10)

            ->get();

        return view('panitia.dashboard_panitia', compact(
            'totalPeserta',
            'totalEvent',
            'sesiAktif',
            'sesiPenuh',
            'grafik',
            'rekapEvent',
            'pendaftaranTerbaru'
        ));
    }
}