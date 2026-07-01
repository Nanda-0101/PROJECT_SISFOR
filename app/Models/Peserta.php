<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta';

    protected $primaryKey = 'id_peserta';

    protected $fillable = [
        'id_pendaftaran'
    ];
}