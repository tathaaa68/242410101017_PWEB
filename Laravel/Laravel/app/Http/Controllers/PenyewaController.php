<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\Peminjaman;
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

    public function pinjamLoker($id)
    {
        $loker = Loker::findOrFail($id);
        $mahasiswa = auth()->user();
        return view('pinjam', compact('loker', 'mahasiswa'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'loker_id' => 'required|exists:lokers,id',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'tgl_kembali' => 'required|date|after:today',
        ]);

        $loker = Loker::find($request->loker_id);

        // Hitung total biaya sewa berdasarkan selisih hari
        $tglPinjam = new \DateTime();
        $tglKembali = new \DateTime($request->tgl_kembali);
        $selisih = $tglPinjam->diff($tglKembali);
        $hari = $selisih->days <= 0 ? 1 : $selisih->days;
        $totalBiaya = $hari * $loker->harga;

        // 1. Simpan transaksi ke tabel peminjamans
        Peminjaman::create([
            'user_id' => $request->mahasiswa_id,
            'loker_id' => $request->loker_id,
            'tgl_pinjam' => now(),
            'tgl_kembali' => $request->tgl_kembali,
            'total_biaya' => $totalBiaya,
            'status_peminjaman' => 'aktif'
        ]);

        // 2. Update status loker menjadi 'disewa'
        $loker->update([
            'status' => 'disewa'
        ]);

        return redirect('/dashboard')->with('success', 'Peminjaman loker berhasil diproses!');
    }
}
