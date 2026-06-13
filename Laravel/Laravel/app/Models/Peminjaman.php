<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    protected $fillable = [
        'id', 'user_id', 
        'loker_id', 
        'tgl_pinjam', 
        'tgl_kembali', 
        'total_biaya', 
        'status_peminjaman', 
        'created_at', 
        'updated_at'
    ];

        public function loker()
    {
        return $this->belongsTo(Loker::class, 'loker_id');
    }
}
