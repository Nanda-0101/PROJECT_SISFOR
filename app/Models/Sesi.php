<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    protected $table = 'sesi';

    protected $primaryKey = 'id_sesi';

    protected $fillable = [
        'id_event',
        'id_kategori',
        'nama_sesi',
        'waktu_mulai',
        'waktu_selesai',
        'kuota_maksimal',
        'status_sesi',
        'created_by',
        'updated_by'
    ];
}