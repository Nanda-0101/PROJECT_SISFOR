<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    protected $table = 'metode_pembayaran';

    protected $primaryKey = 'id_metode';

    protected $fillable = [
        'nama_metode',
        'tipe',
        'status'
    ];

    const UPDATED_AT = null;
}