<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $primaryKey = 'id_pendaftaran';

    protected $fillable = [
        'id_sesi',
        'kode_pendaftaran',
        'waktu_daftar',
        'status_pendaftaran'
    ];
}