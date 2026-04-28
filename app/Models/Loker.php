<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    protected $table = 'loker';

    protected $fillable = [
        'kode',
        'lokasi',
        'ukuran',
        'harga',
        'status',
        'pengelola', 
        'keterangan'
    ];
}