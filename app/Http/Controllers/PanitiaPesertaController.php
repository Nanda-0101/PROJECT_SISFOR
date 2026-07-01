<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanitiaPesertaController extends Controller
{
    public function index(Request $request)
    {
        $idPanitia = session('id_panitia');

        /*
        |--------------------------------------------------------------------------
        | Event milik panitia
        |--------------------------------------------------------------------------
        */

        $events = DB::table('event')
            ->where('created_by', $idPanitia)
            ->select('id_event', 'nama_event')
            ->orderBy('nama_event')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Sesi milik panitia
        |--------------------------------------------------------------------------
        */

        $sesiList = DB::table('sesi')
            ->join('event','sesi.id_event','=','event.id_event')
            ->where('event.created_by',$idPanitia)
            ->select(
                'sesi.id_sesi',
                'sesi.nama_sesi'
            )
            ->orderBy('nama_sesi')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Data Peserta
        |--------------------------------------------------------------------------
        */

        $peserta = DB::table('pendaftaran')

            ->join('peserta','pendaftaran.id_pendaftaran','=','peserta.id_pendaftaran')

            ->join('sesi','pendaftaran.id_sesi','=','sesi.id_sesi')

            ->join('event','sesi.id_event','=','event.id_event')

            ->join('kategori_peserta','sesi.id_kategori','=','kategori_peserta.id_kategori')

            ->leftJoin('data_peserta as nim',function($join){
                $join->on('peserta.id_peserta','=','nim.id_peserta')
                     ->where('nim.id_field',1);
            })

            ->leftJoin('data_peserta as nama',function($join){
                $join->on('peserta.id_peserta','=','nama.id_peserta')
                     ->where('nama.id_field',2);
            })

            ->leftJoin('data_peserta as email',function($join){
                $join->on('peserta.id_peserta','=','email.id_peserta')
                     ->where('email.id_field',3);
            })

            ->leftJoin('data_peserta as wa',function($join){
                $join->on('peserta.id_peserta','=','wa.id_peserta')
                     ->where('wa.id_field',4);
            })

            ->where('event.created_by',$idPanitia);

        if($request->filled('event')){
            $peserta->where('event.id_event',$request->event);
        }

        if($request->filled('sesi')){
            $peserta->where('sesi.id_sesi',$request->sesi);
        }

        $peserta = $peserta
            ->select(
                'nim.nilai as nim',
                'nama.nilai as nama_lengkap',
                'email.nilai as email',
                'wa.nilai as no_wa',
                'event.nama_event',
                'kategori_peserta.nama_kategori',
                'sesi.nama_sesi',
                'pendaftaran.waktu_daftar'
            )
            ->orderByDesc('pendaftaran.waktu_daftar')
            ->get();

        return view('panitia.dataPeserta_panitia', compact(
            'events',
            'sesiList',
            'peserta'
        ));
    }
}