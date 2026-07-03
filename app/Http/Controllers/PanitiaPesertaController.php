<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class PanitiaPesertaController extends Controller
{
    /**
     * Query peserta (dipakai oleh index dan export)
     */
    private function pesertaQuery($idPanitia, Request $request)
    {
        $query = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.id_pendaftaran', '=', 'peserta.id_pendaftaran')
            ->join('sesi', 'pendaftaran.id_sesi', '=', 'sesi.id_sesi')
            ->join('event', 'sesi.id_event', '=', 'event.id_event')
            ->join('kategori_peserta', 'sesi.id_kategori', '=', 'kategori_peserta.id_kategori')
            ->leftJoin('data_peserta as nim', function ($join) {
                $join->on('peserta.id_peserta', '=', 'nim.id_peserta')
                    ->where('nim.id_field', 1);
            })
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
            ->where('event.created_by', $idPanitia);

        if ($request->filled('event')) {
            $query->where('event.id_event', $request->event);
        }

        if ($request->filled('sesi')) {
            $query->where('sesi.id_sesi', $request->sesi);
        }

        return $query->select(
            'nim.nilai as nim',
            'nama.nilai as nama_lengkap',
            'email.nilai as email',
            'wa.nilai as no_wa',
            'event.nama_event',
            'kategori_peserta.nama_kategori',
            'sesi.nama_sesi',
            'pendaftaran.waktu_daftar'
        );
    }

    /**
     * Halaman Data Peserta
     */
    public function index(Request $request)
    {
        $idPanitia = session('id_panitia');

        $events = DB::table('event')
            ->where('created_by', $idPanitia)
            ->select('id_event', 'nama_event')
            ->orderBy('nama_event')
            ->get();

        $sesiList = DB::table('sesi')
            ->join('event', 'sesi.id_event', '=', 'event.id_event')
            ->where('event.created_by', $idPanitia)
            ->select('sesi.id_sesi', 'sesi.nama_sesi')
            ->orderBy('sesi.nama_sesi')
            ->get();

        $peserta = $this->pesertaQuery($idPanitia, $request)
            ->orderByDesc('pendaftaran.waktu_daftar')
            ->get();

        return view('panitia.dataPeserta_panitia', compact(
            'events',
            'sesiList',
            'peserta'
        ));
    }

    /**
     * Export CSV
     */
    public function exportCsv(Request $request): StreamedResponse
    {
        $idPanitia = session('id_panitia');

        $peserta = $this->pesertaQuery($idPanitia, $request)
            ->orderByDesc('pendaftaran.waktu_daftar')
            ->get();

        $filename = 'data_peserta_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        return response()->stream(function () use ($peserta) {
            $file = fopen('php://output', 'w');
            fwrite($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, [
                'NIM', 'Nama Lengkap', 'Email', 'No. WA',
                'Event', 'Kategori', 'Sesi', 'Waktu Daftar'
            ]);

            foreach ($peserta as $row) {
                fputcsv($file, [
                    $row->nim,
                    $row->nama_lengkap,
                    $row->email,
                    $row->no_wa,
                    $row->nama_event,
                    $row->nama_kategori,
                    $row->nama_sesi,
                    $row->waktu_daftar
                ]);
            }
            fclose($file);
        }, 200, $headers);
    }

    /**
     * Export PDF
     */
    public function exportPdf(Request $request)
    {
        $idPanitia = session('id_panitia');

        $panitia = DB::table('panitia')
            ->where('id_panitia', $idPanitia)
            ->first();

        $peserta = $this->pesertaQuery($idPanitia, $request)
            ->orderByDesc('pendaftaran.waktu_daftar')
            ->get();

        $totalPeserta = $peserta->count();

        // Ambil informasi event dan sesi untuk filter
        $eventName = 'Semua Event';
        $sesiName = 'Semua Sesi';

        if ($request->filled('event')) {
            $event = DB::table('event')->where('id_event', $request->event)->first();
            $eventName = $event->nama_event ?? 'Semua Event';
        }

        if ($request->filled('sesi')) {
            $sesi = DB::table('sesi')->where('id_sesi', $request->sesi)->first();
            $sesiName = $sesi->nama_sesi ?? 'Semua Sesi';
        }

        $data = [
            'peserta' => $peserta,
            'panitia' => $panitia,
            'totalPeserta' => $totalPeserta,
            'eventName' => $eventName,
            'sesiName' => $sesiName,
            'tanggalCetak' => now()->translatedFormat('d F Y H:i'),
            'filterEvent' => $request->event,
            'filterSesi' => $request->sesi,
        ];

        $pdf = Pdf::loadView('panitia.export_pdf', $data);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('data_peserta_' . date('Ymd_His') . '.pdf');
    }
}