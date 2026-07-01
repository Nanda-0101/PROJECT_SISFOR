<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel di database sesuai file SQL Anda
    protected $table = 'admin';

    // Primary key custom karena bukan 'id'
    protected $primaryKey = 'id_admin';

    // Kolom yang dapat diisi secara massal (Mass Assignment)
    protected $fillable = [
        'username',
        'password',
        'nama_admin',
    ];

    // Menyembunyikan password saat data model diubah menjadi array atau JSON
    protected $hidden = [
        'password',
    ];
}