<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Panitia extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel di database sesuai file SQL Anda
    protected $table = 'panitia';

    // Primary key custom karena bukan 'id'
    protected $primaryKey = 'id_panitia';

    // Kolom yang dapat diisi secara massal (Mass Assignment)
    protected $fillable = [
        'username',
        'password',
        'nama_panitia',
    ];

    // Menyembunyikan password demi keamanan aplikasi
    protected $hidden = [
        'password',
    ];
}