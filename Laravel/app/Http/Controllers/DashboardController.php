<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loker; 

class DashboardController extends Controller
{
    public function index()
    {
        $loker = Loker::all();
        session()->flash('success', 'Data berhasil dimuat!');
        return view('dashboard', compact('loker'));
    }
}
