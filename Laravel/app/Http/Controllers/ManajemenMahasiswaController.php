<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ManajemenMahasiswaController extends Controller
{
    public function index()
    {
        // $mahasiswa = Mahasiswa::latest()->paginate(10); 
        //ambil data yang hanya ditambahkan pengguna user id ini
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->latest()->paginate(10);
        return view('Dashboard.ManajemenMahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('Dashboard.ManajemenMahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim'      => 'required|unique:mahasiswa,nim',
            'nama'     => 'required|string|min:3|max:255',
            'prodi'    => 'required|in:Sistem Informasi,Teknologi Informasi,Informatika',
            'angkatan' => 'required|numeric',
            'email'    => 'required|email|unique:mahasiswa,email',
            'foto'     => 'nullable|mimes:jpg,png,webp|max:2048', // Validasi foto
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id(); // Simpan user_id saat membuat data mahasiswa

        // Logika Upload Foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-mahasiswa', 'public');
        }

        Mahasiswa::create($data);

        return redirect()->route('manajemen-mahasiswa.index')
                         ->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function show($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        return view('Dashboard.ManajemenMahasiswa.show', compact('mhs'));
    }

    public function edit($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        return view('Dashboard.ManajemenMahasiswa.edit', compact('mhs'));
    }

    public function update(Request $request, $id)
    {
        $mhs = Mahasiswa::findOrFail($id);

        $request->validate([
            'nama'     => 'required|string|min:3|max:255',
            'prodi'    => 'required|in:Sistem Informasi,Teknologi Informasi,Informatika',
            'angkatan' => 'required|numeric',
            'email'    => 'required|email|unique:mahasiswa,email,' . $id,
            'foto'     => 'nullable|mimes:jpg,png,webp|max:2048',
        ]);

        $data = $request->all();

        // Logika Update Foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($mhs->foto) {
                Storage::disk('public')->delete($mhs->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-mahasiswa', 'public');
        }

        $mhs->update($data);

        return redirect()->route('manajemen-mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mhs = Mahasiswa::findOrFail($id);

        // Hapus foto dari storage sebelum data dihapus
        if ($mhs->foto) {
            Storage::disk('public')->delete($mhs->foto);
        }

        $mhs->delete();

        return redirect()->route('manajemen-mahasiswa.index')
                         ->with('success', 'Mahasiswa berhasil dihapus!');
    }
    
}