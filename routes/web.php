<?php

use Illuminate\Support\Facades\Route;

Route::get('/panitia-login', function () {
    return view('panitia.loginpage_panitia'); 
});

Route::get('/panitia-dashboard', function () {
    return view('panitia.dashboard_panitia');
});

Route::get('/panitia-data-peserta', function () {
    return view('panitia.dataPeserta_panitia');
});

Route::get('/panitia-profil', function () {
    return view('panitia.profil_panitia');
});

Route::get('/panitia-tutup-sesi', function () {
    return view('panitia.tutupSesi_panitia');
});

Route::get('/public-landingpage', function () {
    return view('public.landingpage_public'); 
});
