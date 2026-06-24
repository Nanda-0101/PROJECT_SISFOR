<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/public-login', function () {
    return view('public.loginpage_public'); 
});

Route::get('/public-landingpage', function () {
    return view('public.landingpage_public'); 
});