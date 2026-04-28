<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loker; 

class DashboardController extends Controller
{
    public function index()
    {
        $loker = Loker::all();
        return view('dashboard', compact('loker'));
    }
}
