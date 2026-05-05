<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    // Relasi Many-to-Many ke Gedung
    public function gedungs()
    {
        /**
         * parameter 1: Model tujuan
         * parameter 2: Nama tabel pivot kustom Anda
         */
        return $this->belongsToMany(Gedung::class, 'kode_gudang');
    }
}