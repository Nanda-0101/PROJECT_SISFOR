<?php

namespace App\Http\Controllers;

use App\Models\Event;

class LandingPageController extends Controller
{
    public function index()
    {
        // Hanya tampilkan event dengan status 'publikasi'
        $events = Event::with([
            'sesi.pendaftaran',
            'sesi.kategori'  // tambahkan relasi kategori
        ])
        ->where('status_event', 'publikasi')  // hanya publikasi
        ->orderBy('tanggal_event', 'asc')
        ->get();

        return view('public.landingpage_public', compact('events'));
    }
}