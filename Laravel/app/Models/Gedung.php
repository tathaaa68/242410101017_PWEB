<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $fillable = ['nama_gedung', 'kode_gedung'];

    // Relasi Many-to-Many ke Loker
    public function lokers()
    {
        return $this->belongsToMany(Loker::class, 'kode_gudang');
    }
}