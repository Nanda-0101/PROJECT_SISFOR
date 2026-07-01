<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panitia extends Model
{
    protected $table = 'panitia';

    protected $primaryKey = 'id_panitia';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'username',
        'password',
        'nama_panitia',
        'status'
    ];

    protected $hidden = [
        'password'
    ];
}