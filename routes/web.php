<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\PanitiaLoginController;
use App\Http\Controllers\PanitiaDashboardController;
use App\Http\Controllers\PanitiaPesertaController;


/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/public-landingpage', function () {
    return view('public.landingpage_public');
});

Route::get('/pendaftaran-peserta', function () {
    return view('public.pendaftaranPeserta_public');
});

Route::get('/cekstatuspendaftaran-peserta', function () {
    return view('public.cekStatusPendaftaran_public');
});


/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/

// Halaman Login
Route::get('/admin-login', [AdminLoginController::class, 'index'])
    ->name('admin.login');

// Proses Login
Route::post('/admin-login', [AdminLoginController::class, 'login'])
    ->name('admin.login.submit');

// Logout
Route::get('/admin-logout', [AdminLoginController::class, 'logout'])
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ADMIN (Middleware Admin)
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    Route::get('/admin-dashboardadmin', function () {
        return view('admin.dashboard_admin');
    })->name('admin.dashboard');

    Route::get('/admin-pembuatanevent', function () {
        return view('admin.buatEvent_admin');
    })->name('admin.buat.event');

    Route::get('/admin-kelolaadmin', function () {
        return view('admin.kelolaAdmin_admin');
    })->name('admin.kelola.admin');

    Route::get('/admin-kelolaevent', function () {
        return view('admin.kelolaEvent_admin');
    })->name('admin.kelola.event');

    Route::get('/admin-kelolapanitia', function () {
        return view('admin.kelolaPanitia_admin');
    })->name('admin.kelola.panitia');

    Route::get('/admin-profiladmin', function () {
        return view('admin.profil_admin');
    })->name('admin.profil');

});


/*
|--------------------------------------------------------------------------
| LOGIN PANITIA
|--------------------------------------------------------------------------
*/

// Halaman Login
Route::get('/panitia-login', [PanitiaLoginController::class, 'index'])
    ->name('panitia.login');

// Proses Login
Route::post('/panitia-login', [PanitiaLoginController::class, 'login'])
    ->name('panitia.login.submit');

// Logout
Route::get('/panitia-logout', [PanitiaLoginController::class, 'logout'])
    ->name('panitia.logout');


/*
|--------------------------------------------------------------------------
| PANITIA (Middleware Panitia)
|--------------------------------------------------------------------------
*/

Route::middleware('panitia')->group(function () {

    Route::get('/panitia-dashboard',
        [PanitiaDashboardController::class,'index'])
        ->name('panitia.dashboard');

    Route::get('/panitia-data-peserta',
        [PanitiaPesertaController::class,'index'])
        ->name('panitia.data.peserta');

    Route::get('/panitia-profil', function () {
        return view('panitia.profil_panitia');
    })->name('panitia.profil');

    Route::get('/panitia-tutup-sesi', function () {
        return view('panitia.tutupSesi_panitia');
    })->name('panitia.tutup.sesi');

});


/*
|--------------------------------------------------------------------------
| Redirect Default
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/public-landingpage');