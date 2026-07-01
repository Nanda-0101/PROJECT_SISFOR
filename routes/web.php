<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminProfilController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AdminKelolaEventController;

use App\Http\Controllers\KelolaAdminController;
use App\Http\Controllers\KelolaPanitiaController;

use App\Http\Controllers\PanitiaLoginController;
use App\Http\Controllers\PanitiaDashboardController;
use App\Http\Controllers\PanitiaPesertaController;
use App\Http\Controllers\PanitiaTutupSesiController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\CekStatusPendaftaranController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingPageController::class, 'index'])
    ->name('landing.page');
    
Route::get('/public-landingpage', [LandingPageController::class, 'index'])
    ->name('landing.page.public');
    
// Public routes
Route::get('/pendaftaran-peserta', [PendaftaranController::class, 'index'])
    ->name('pendaftaran.index');

Route::post('/pendaftaran', [PendaftaranController::class, 'store'])
    ->name('pendaftaran.store');

Route::get('/pendaftaran/success', [PendaftaranController::class, 'success'])
    ->name('pendaftaran.success');

// API endpoints untuk AJAX
Route::get('/api/event/{id}/sesi', [PendaftaranController::class, 'getSesi']);
Route::get('/api/kategori/{id}/fields', [PendaftaranController::class, 'getFields']);

// Payment
Route::post('/payment/confirm', [PendaftaranController::class, 'confirmPayment'])->name('payment.confirm');
Route::get('/payment/success', [PendaftaranController::class, 'paymentCallback']);

// Cek Status
Route::get('/cekstatuspendaftaran-peserta', [CekStatusPendaftaranController::class, 'index'])
    ->name('cek.status.index');

Route::post('/cek-status', [CekStatusPendaftaranController::class, 'cek'])
    ->name('cek.status');

/*
|--------------------------------------------------------------------------
| ADMIN LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/admin-login', [AdminLoginController::class, 'index'])
    ->name('admin.login');

Route::post('/admin-login', [AdminLoginController::class, 'login'])
    ->name('admin.login.submit');

Route::get('/admin-logout', [AdminLoginController::class, 'logout'])
    ->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (MIDDLEWARE)
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */
    Route::view('/admin-dashboardadmin', 'admin.dashboard_admin')
        ->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | EVENT MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::get('/admin-pembuatanevent', [AdminEventController::class, 'create'])
        ->name('admin.buat.event');

    Route::post('/admin-store-event', [AdminEventController::class, 'store'])
        ->name('admin.store.event');

    Route::get('/admin-kelolaevent', [AdminKelolaEventController::class, 'index'])
        ->name('admin.kelola.event');

    Route::put('/admin/event/{id}', [AdminKelolaEventController::class, 'update'])
        ->name('admin.update.event');

    Route::delete('/admin/event/{id}', [AdminKelolaEventController::class, 'destroy'])
        ->name('admin.delete.event');

    Route::put('/admin/event/complete/{id}', [AdminKelolaEventController::class, 'complete'])
        ->name('admin.complete.event');

    /*
    |--------------------------------------------------------------------------
    | KELOLA ADMIN (FIXED CONTROLLER)
    |--------------------------------------------------------------------------
    */

    Route::get('/admin-kelolaadmin', [KelolaAdminController::class, 'index'])
        ->name('admin.kelola.admin');

    Route::delete('/admin-kelolaadmin/{id}', [KelolaAdminController::class, 'destroy'])
        ->name('admin.destroy');

    Route::post('/admin-kelolaadmin', [KelolaAdminController::class, 'store'])
        ->name('admin.store');

    /*
    |--------------------------------------------------------------------------
    | KELOLA PANITIA (FIXED CONTROLLER)
    |--------------------------------------------------------------------------
    */

    Route::get('/admin-kelolapanitia', [KelolaPanitiaController::class, 'index'])
        ->name('admin.kelola.panitia');

    Route::delete('/admin-kelolapanitia/{id}', [KelolaPanitiaController::class, 'destroy'])
        ->name('panitia.destroy');

    Route::post('/admin-kelolapanitia', [KelolaPanitiaController::class,'store'])
        ->name('panitia.store');

    /*
    |--------------------------------------------------------------------------
    | PROFIL ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin-profiladmin', [AdminProfilController::class, 'index'])
        ->name('admin.profil');

    Route::post('/admin-profiladmin', [AdminProfilController::class, 'update'])
        ->name('admin.profil.update');
});

/*
|--------------------------------------------------------------------------
| PANITIA LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/panitia-login', [PanitiaLoginController::class, 'index'])
    ->name('panitia.login');

Route::post('/panitia-login', [PanitiaLoginController::class, 'login'])
    ->name('panitia.login.submit');

Route::get('/panitia-logout', [PanitiaLoginController::class, 'logout'])
    ->name('panitia.logout');

/*
|--------------------------------------------------------------------------
| PANITIA PANEL (MIDDLEWARE)
|--------------------------------------------------------------------------
*/

Route::middleware('panitia')->group(function () {

    Route::get('/panitia-dashboard', [PanitiaDashboardController::class, 'index'])
        ->name('panitia.dashboard');

    Route::get('/panitia-data-peserta', [PanitiaPesertaController::class, 'index'])
        ->name('panitia.data.peserta');

    Route::get('/panitia-data-peserta/export', [PanitiaPesertaController::class, 'exportCsv'])
        ->name('panitia.data.peserta.export');

    Route::get('/panitia-tutup-sesi', [PanitiaTutupSesiController::class, 'index'])
        ->name('panitia.tutup.sesi');

    Route::post('/panitia/tutup-sesi/{id}', [PanitiaTutupSesiController::class, 'tutupSesi'])
        ->name('panitia.tutup.sesi.proses');

    Route::view('/panitia-profil', 'panitia.profil_panitia')
        ->name('panitia.profil');
});

/*
|--------------------------------------------------------------------------
| REDIRECT ROOT
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/public-landingpage');