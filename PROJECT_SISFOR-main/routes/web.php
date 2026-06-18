<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login-mahasiswa', function () {
    return view('mahasiswa.mahasiswa_login');
});