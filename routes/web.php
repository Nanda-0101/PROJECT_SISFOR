<?php

use Illuminate\Support\Facades\Route;

Route::get('/panitia-login', function () {
    return view('panitia.loginpage_panitia'); 
});

Route::get('/public-landingpage', function () {
    return view('public.landingpage_public'); 
});
