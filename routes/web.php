<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PanitiaLoginController;
use App\Http\Controllers\PanitiaDashboardController;
use App\Http\Controllers\PanitiaPesertaController;
use App\Http\Controllers\PanitiaTutupSesiController;

/*
|--------------------------------------------------------------------------
| Public / Pengunjung Umum
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

// Halaman Login Admin
Route::get('/admin-login', [AdminLoginController::class, 'index'])
    ->name('admin.login');

// Proses Login Admin
Route::post('/admin-login', [AdminLoginController::class, 'login'])
    ->name('admin.login.submit');

// Proses Logout Admin
Route::get('/admin-logout', [AdminLoginController::class, 'logout'])
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| PANEL ADMIN (Dilindungi Middleware Admin)
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    // Dashboard Utama Admin
    Route::get('/admin-dashboardadmin', function () {
        return view('admin.dashboard_admin');
    })->name('admin.dashboard');

    // Pembuatan Event Baru
    Route::get('/admin-pembuatanevent', function () {
        return view('admin.buatEvent_admin');
    })->name('admin.buat.event');

    // CRUD: Menampilkan Menu Kelola Admin & Aksi Hapus
    Route::get('/admin-kelolaadmin', [AdminController::class, 'indexAdmin'])
        ->name('admin.kelola.admin');
        
    Route::delete('/admin-kelolaadmin/{id}', [AdminController::class, 'destroyAdmin'])
        ->name('admin.destroy');

    // Menu Kelola Event
    Route::get('/admin-kelolaevent', function () {
        return view('admin.kelolaEvent_admin');
    })->name('admin.kelola.event');

    // CRUD: Menampilkan Menu Kelola Panitia & Aksi Hapus
    Route::get('/admin-kelolapanitia', [AdminController::class, 'indexPanitia'])
        ->name('admin.kelola.panitia');
        
    Route::delete('/admin-kelolapanitia/{id}', [AdminController::class, 'destroyPanitia'])
        ->name('panitia.destroy');

    // Profil Admin
    Route::get('/admin-profiladmin', function () {
        return view('admin.profil_admin');
    })->name('admin.profil');

});


/*
|--------------------------------------------------------------------------
| LOGIN PANITIA
|--------------------------------------------------------------------------
*/

// Halaman Login Panitia
Route::get('/panitia-login', [PanitiaLoginController::class, 'index'])
    ->name('panitia.login');

// Proses Login Panitia
Route::post('/panitia-login', [PanitiaLoginController::class, 'login'])
    ->name('panitia.login.submit');

// Proses Logout Panitia
Route::get('/panitia-logout', [PanitiaLoginController::class, 'logout'])
    ->name('panitia.logout');


/*
|--------------------------------------------------------------------------
| PANEL PANITIA (Dilindungi Middleware Panitia)
|--------------------------------------------------------------------------
*/

Route::middleware('panitia')->group(function () {

    // Dashboard Utama Panitia
    Route::get('/panitia-dashboard', [PanitiaDashboardController::class, 'index'])
        ->name('panitia.dashboard');

    // Rekap & Filter Data Peserta Event
    Route::get('/panitia-data-peserta', [PanitiaPesertaController::class, 'index'])
        ->name('panitia.data.peserta');

    // Manajemen Penutupan Sesi Registrasi Event
    Route::get('/panitia-tutup-sesi', [PanitiaTutupSesiController::class, 'index'])
        ->name('panitia.tutup.sesi');

    Route::post('/panitia/tutup-sesi/{id}', [PanitiaTutupSesiController::class, 'tutupSesi'])
        ->name('panitia.tutup.sesi.proses');

    // Profil Panitia
    Route::get('/panitia-profil', function () {
        return view('panitia.profil_panitia');
    })->name('panitia.profil');

});


/*
|--------------------------------------------------------------------------
| Pengalihan Alamat Default (Root URL Redirect)
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/public-landingpage');