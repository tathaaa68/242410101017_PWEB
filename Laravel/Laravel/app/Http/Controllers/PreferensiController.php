<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PreferensiController extends Controller
{

    public function index()
    {
        return view('preferensi');
    }


    public function save(Request $request)
    {
        $theme = $request->input('theme');
        $fontSize = $request->input('font_size');

        $cookieLama = $request->cookie('theme', 'Belum Ada');


        $cookieTheme = cookie('theme', $theme, 525600, '/', null, false, false);
        $cookieFont = cookie('font_size', $fontSize, 525600, '/', null, false, false);

        return response()->json([
            'status' => 'success',
            'message' => 'Preferensi berhasil disimpan!',
            'cookie_dibaca' => $cookieLama,
            'tema_baru' => $theme
        ])
            ->cookie($cookieTheme)
            ->cookie($cookieFont);
    }
}
