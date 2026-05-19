<?php

namespace App\Http\Controllers;

use App\Models\Loker; 
use Illuminate\Http\Request;

class LokerController extends Controller
{
    public function index()
{
    $data_loker = \App\Models\Loker::all();

    return view('dashboard', [
        'data_loker'  => $data_loker,
        'total_loker' => $data_loker->count(),
        'tersedia'    => $data_loker->where('status', 'tersedia')->count(),
        'disewa'      => $data_loker->where('status', 'disewa')->count(),
        'maintenance' => $data_loker->where('status', 'maintenance')->count(),
    ]);

    
}
public function showJson($id)
{
    // Cari loker, jika tidak ketemu langsung return error 404
    $loker = Loker::findOrFail($id);
    
    // Kembalikan data dalam bentuk JSON
    return response()->json($loker);
}
}