<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPeserta extends Model
{
    protected $table = 'data_peserta';
    protected $primaryKey = 'id_data';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_peserta',
        'id_field',
        'nilai'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi ke Peserta
    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id_peserta');
    }

    // Relasi ke Field Kategori
    public function field()
    {
        return $this->belongsTo(FieldKategori::class, 'id_field', 'id_field');
    }
}