<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Sesi extends Model
    {
        protected $table = 'sesi';
        protected $primaryKey = 'id_sesi';
        public $incrementing = true;
        protected $keyType = 'int';

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

        protected $casts = [
            'waktu_mulai' => 'datetime',
            'waktu_selesai' => 'datetime',
            'kuota_maksimal' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];

        // Relasi ke Event
        public function event()
        {
            return $this->belongsTo(Event::class, 'id_event', 'id_event');
        }

        // Relasi ke Kategori Peserta
        public function kategori()
        {
            return $this->belongsTo(KategoriPeserta::class, 'id_kategori', 'id_kategori');
        }

        // Relasi ke Panitia (creator)
        public function creator()
        {
            return $this->belongsTo(Panitia::class, 'created_by', 'id_panitia');
        }

        // Relasi ke Panitia (updater)
        public function updater()
        {
            return $this->belongsTo(Panitia::class, 'updated_by', 'id_panitia');
        }

        // Relasi ke Pendaftaran
        public function pendaftaran()
        {
            return $this->hasMany(Pendaftaran::class, 'id_sesi', 'id_sesi');
        }
    }