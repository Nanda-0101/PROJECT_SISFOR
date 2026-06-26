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

Route::get('/admin-dashboardadmin', function () {
    return view('admin.dashboard_admin'); 
});

Route::get('/admin-pembuatanevent', function () {
    return view('admin.buatEvent_admin'); 
});

Route::get('/admin-kelolaadmin', function () {
    return view('admin.kelolaAdmin_admin'); 
});

Route::get('/admin-kelolaevent', function () {
    return view('admin.kelolaEvent_admin'); 
});

Route::get('/admin-kelolapanitia', function () {
    return view('admin.kelolaPanitia_admin'); 
});

Route::get('/admin-profiladmin', function () {
    return view('admin.profil_admin'); 
});