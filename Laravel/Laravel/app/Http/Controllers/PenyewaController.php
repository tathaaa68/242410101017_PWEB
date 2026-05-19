<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    public function index(Request $request)
    {
        $query = Penyewa::with('user');

        if ($request->filled('searchPenyewa')) {
            $query->where(function ($q) use ($request) {
                $q->where('nim', 'like', '%' . $request->searchPenyewa . '%')
                    ->orWhereHas('user', function ($qUser) use ($request) {
                        $qUser->where('name', 'like', '%' . $request->searchPenyewa . '%');
                    });
            });
        }

        if ($request->filled('searchLoker')) {
            $query->where('kode_loker', 'like', '%' . $request->searchLoker . '%');
        }

        if ($request->filled('statusSewa')) {
            $query->where('status', $request->statusSewa);
        }

        $penyewa = $query->get();

        if ($request->ajax()) {
            $data = $penyewa->map(function ($p) {
                return [
                    'id' => $p->id,
                    'nim' => $p->nim,
                    'nama' => $p->user ? $p->user->name : 'User Tidak Diketahui',
                    'prodi' => $p->prodi,
                    'kode_loker' => $p->kode_loker,
                    'tgl_mulai' => date('d M Y', strtotime($p->tgl_mulai)),
                    'tgl_selesai' => date('d M Y', strtotime($p->tgl_selesai)),
                    'status' => $p->status,
                    'is_admin' => auth()->check() && auth()->user()->role === 'admin'
                ];
            });

            return response()->json([
                'data' => $data,
                'total' => $penyewa->count()
            ]);
        }

        // JIKA BUKAN AJAX (LOAD HALAMAN PERTAMA KALI)
        return view('penyewa', compact('penyewa'));
    }
}
