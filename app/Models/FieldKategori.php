<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldKategori extends Model
{
    protected $table = 'field_kategori';

    protected $primaryKey = 'id_field';

    protected $fillable = [
        'id_kategori',
        'nama_field',
        'tipe_field',
        'wajib'
    ];
}