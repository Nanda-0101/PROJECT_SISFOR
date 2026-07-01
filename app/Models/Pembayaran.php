<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_pendaftaran',
        'id_metode',
        'kode_pembayaran',
        'nominal',
        'bukti_pembayaran',
        'status_pembayaran',
        'tanggal_pembayaran',
        'diverifikasi_oleh'
    ];
}