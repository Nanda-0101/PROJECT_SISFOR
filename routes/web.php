<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminProfilController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AdminKelolaEventController;

use App\Http\Controllers\PanitiaLoginController;
use App\Http\Controllers\PanitiaDashboardController;
use App\Http\Controllers\PanitiaPesertaController;
use App\Http\Controllers\PanitiaTutupSesiController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::view('/', 'public.landingpage_public');

Route::view('/public-landingpage', 'public.landingpage_public');

Route::view(
    '/pendaftaran-peserta',
    'public.pendaftaranPeserta_public'
);

Route::view(
    '/cekstatuspendaftaran-peserta',
    'public.cekStatusPendaftaran_public'
);

/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/

Route::controller(AdminLoginController::class)->group(function () {

    Route::get('/admin-login', 'index')
        ->name('admin.login');

    Route::post('/admin-login', 'login')
        ->name('admin.login.submit');

    Route::post('/admin-logout', 'logout')
        ->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/admin-dashboardadmin',
        'admin.dashboard_admin'
    )->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | EVENT
    |--------------------------------------------------------------------------
    */

    // Form Buat Event
    Route::get(
        '/admin-pembuatanevent',
        [AdminEventController::class, 'create']
    )->name('admin.buat.event');

    // Simpan Event
    Route::post(
        '/admin-store-event',
        [AdminEventController::class, 'store']
    )->name('admin.store.event');

    // Kelola Event
    Route::get(
        '/admin-kelolaevent',
        [AdminKelolaEventController::class, 'index']
    )->name('admin.kelola.event');

    // Update Event (Modal Edit)
    Route::put(
        '/admin/event/{id}',
        [AdminKelolaEventController::class, 'update']
    )->name('admin.update.event');

    // Delete Event
    Route::delete(
        '/admin/event/{id}',
        [AdminKelolaEventController::class, 'destroy']
    )->name('admin.delete.event');

    // Tandai Event Selesai
    Route::put('/admin/event/complete/{id}',
        [AdminKelolaEventController::class, 'complete']
        )->name('admin.complete.event');

    /*
    |--------------------------------------------------------------------------
    | KELOLA ADMIN
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/admin-kelolaadmin',
        'admin.kelolaAdmin_admin'
    )->name('admin.kelola.admin');

    /*
    |--------------------------------------------------------------------------
    | KELOLA PANITIA
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/admin-kelolapanitia',
        'admin.kelolaPanitia_admin'
    )->name('admin.kelola.panitia');

    /*
    |--------------------------------------------------------------------------
    | PROFIL ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin-profiladmin',
        [AdminProfilController::class, 'index']
    )->name('admin.profil');

    Route::post(
        '/admin-profiladmin',
        [AdminProfilController::class, 'update']
    )->name('admin.profil.update');
});

/*
|--------------------------------------------------------------------------
| LOGIN PANITIA
|--------------------------------------------------------------------------
*/

Route::controller(PanitiaLoginController::class)->group(function () {

    Route::get('/panitia-login', 'index')
        ->name('panitia.login');

    Route::post('/panitia-login', 'login')
        ->name('panitia.login.submit');

    Route::get('/panitia-logout', 'logout')
        ->name('panitia.logout');
});

/*
|--------------------------------------------------------------------------
| PANITIA
|--------------------------------------------------------------------------
*/

Route::middleware('panitia')->group(function () {

    Route::get(
        '/panitia-dashboard',
        [PanitiaDashboardController::class, 'index']
    )->name('panitia.dashboard');

    Route::get(
        '/panitia-data-peserta',
        [PanitiaPesertaController::class, 'index']
    )->name('panitia.data.peserta');

    Route::get(
        '/panitia-tutup-sesi',
        [PanitiaTutupSesiController::class, 'index']
    )->name('panitia.tutup.sesi');

    Route::post(
        '/panitia/tutup-sesi/{id}',
        [PanitiaTutupSesiController::class, 'tutupSesi']
    )->name('panitia.tutup.sesi.proses');

    Route::view(
        '/panitia-profil',
        'panitia.profil_panitia'
    )->name('panitia.profil');
});