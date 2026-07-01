<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';

    protected $primaryKey = 'id_event';

    public $timestamps = false;

    protected $fillable = [
        'nama_event',
        'deskripsi',
        'tanggal_event',
        'lokasi',
        'jenis_event',
        'biaya',
        'status_event',
        'created_by',
        'updated_by'
    ];

    /**
     * Panitia yang membuat event
     */
    public function panitia()
    {
        return $this->belongsTo(
            Panitia::class,
            'created_by',
            'id_panitia'
        );
    }
    public function sesi()
    {
        return $this->hasMany(Sesi::class, 'id_event', 'id_event');
        }
}