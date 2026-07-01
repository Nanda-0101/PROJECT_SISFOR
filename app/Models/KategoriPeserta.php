<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPeserta extends Model
{
    protected $table = 'kategori_peserta';
    protected $primaryKey = 'id_kategori';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'created_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi ke Panitia (creator)
    public function creator()
    {
        return $this->belongsTo(Panitia::class, 'created_by', 'id_panitia');
    }

    // Relasi ke Field Kategori
    public function fields()
    {
        return $this->hasMany(FieldKategori::class, 'id_kategori', 'id_kategori');
    }

    // Relasi ke Sesi
    public function sesi()
    {
        return $this->hasMany(Sesi::class, 'id_kategori', 'id_kategori');
    }
}