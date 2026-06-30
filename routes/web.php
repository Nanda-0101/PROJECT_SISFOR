<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;

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
| Login Admin
|--------------------------------------------------------------------------
*/

// Menampilkan halaman login
Route::get('/admin-login', [AdminLoginController::class, 'index'])
    ->name('admin.login');

// Proses login
Route::post('/admin-login', [AdminLoginController::class, 'login'])
    ->name('admin.login.submit');

// Logout
Route::get('/admin-logout', [AdminLoginController::class, 'logout'])
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| Admin (Dilindungi Middleware)
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    Route::get('/admin-dashboardadmin', function () {
        return view('admin.dashboard_admin');
    })->name('admin.dashboard');

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

});


/*
|--------------------------------------------------------------------------
| Panitia
|--------------------------------------------------------------------------
*/

Route::get('/panitia-login', function () {
    return view('panitia.loginpage_panitia');
});

Route::get('/panitia-dashboard', function () {
    return view('panitia.dashboard_panitia');
});

Route::get('/panitia-data-peserta', function () {
    return view('panitia.dataPeserta_panitia', [
        'totalPeserta' => 0,
        'totalEvent'   => 0,
        'totalSesi'    => 0,
        'sesiPenuh'    => 0,
        'peserta'      => collect([]),
        'events'       => collect([]),
        'sesiList'     => collect([]),
    ]);
});

Route::get('/panitia-profil', function () {
    return view('panitia.profil_panitia');
});

// Menggunakan penamaan route panitia yang konsisten
Route::get('/panitia-tutup-sesi', function () {
    return view('panitia.tutupSesi_panitia');
});

Route::get('/tutupsesi-panitia', function () {
    return view('panitia.tutupSesi_panitia'); 
});