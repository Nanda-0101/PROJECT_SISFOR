<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    public $incrementing = true;
    protected $keyType = 'int';

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

    protected $casts = [
        'nominal' => 'decimal:2',
        'tanggal_pembayaran' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi ke Pendaftaran
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran', 'id_pendaftaran');
    }

    // Relasi ke Metode Pembayaran
    public function metode()
    {
        return $this->belongsTo(MetodePembayaran::class, 'id_metode', 'id_metode');
    }

    // Relasi ke Panitia (verifikator)
    public function verifikator()
    {
        return $this->belongsTo(Panitia::class, 'diverifikasi_oleh', 'id_panitia');
    }
}