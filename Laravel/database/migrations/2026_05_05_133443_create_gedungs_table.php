<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'nama_gedung',
        'kode_gedung',
        'jumlah_lantai',
        'deskripsi_lokasi',
        'is_aktif', // Menambahkan kolom status aktif gedung
    ];

    // Mengonversi tipe data saat keluar/masuk database
    protected $casts = [
        'jumlah_lantai' => 'integer',
        'is_aktif' => 'boolean',
    ];

    // Local Scope untuk memfilter gedung yang sedang aktif/beroperasi
    public function scopeScopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

    // Relasi ke Loker
    public function lokers()
    {
        return $this->hasMany(Loker::class);
    }
}