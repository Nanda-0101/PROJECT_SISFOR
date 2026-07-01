<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';

    protected $primaryKey = 'id_log';

    public $timestamps = false;

    protected $fillable = [
        'aktivitas',
        'jenis_user',
        'id_admin',
        'id_panitia',
        'waktu_aktivitas'
    ];
}