<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loker;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $query = Loker::query();

        if ($request->filled('searchKode')) {
            $query->where(function ($q) use ($request) {
                $q->where('kode', 'like', '%' . $request->searchKode . '%')
                    ->orWhere('pengelola', 'like', '%' . $request->searchKode . '%');
            });
        }

        if ($request->filled('searchLokasi')) {
            $query->where('lokasi', 'like', '%' . $request->searchLokasi . '%');
        }

        if ($request->filled('searchStatus')) {
            $query->where('status', $request->searchStatus);
        }

        if ($request->has('status') && is_array($request->status)) {
            $query->whereIn('status', $request->status);
        }
        if ($request->has('ukuran') && is_array($request->ukuran)) {
            $query->whereIn('ukuran', $request->ukuran);
        }
        if ($request->has('harga') && is_array($request->harga)) {
            $query->whereIn('harga', $request->harga);
        }
        if ($request->has('gedung') && is_array($request->gedung)) {
            $query->where(function ($q) use ($request) {
                foreach ($request->gedung as $gedung) {
                    $q->orWhere('lokasi', 'like', '%' . $gedung . '%');
                }
            });
        }

        $loker = $query->get();

        $kunjungan = $request->session()->get('visitor_stats');

        if (!$kunjungan) {
            $kunjungan = [
                'count' => 1,
                'first_visit' => now(),
                'last_visit' => now(),
            ];
        } else {
            $kunjungan['count']++;
            $kunjungan['last_visit'] = now();
        }

        $request->session()->put('visitor_stats', $kunjungan);

        return view('dashboard', compact('loker', 'kunjungan'));
    }
    public function resetKunjungan(Request $request)
    {
        $request->session()->forget('visitor_stats');
        return back()->with('success', 'Statistik kunjungan telah direset.');
    }
}
