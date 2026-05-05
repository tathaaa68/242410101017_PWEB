<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gedung; // Pastikan Model Gedung sudah ada

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataGedung = [
            [
                'nama_gedung' => 'Gedung A - Fasilkom',
                'kode_gedung' => 'F-A',
                'jumlah_lantai' => 3,
                'deskripsi_lokasi' => 'Sebelah utara taman fakultas',
                'is_aktif' => true,
            ],
            [
                'nama_gedung' => 'Gedung B - Laboratorium',
                'kode_gedung' => 'F-B',
                'jumlah_lantai' => 2,
                'deskripsi_lokasi' => 'Area belakang dekanat',
                'is_aktif' => true,
            ],
            [
                'nama_gedung' => 'Gedung C - Aula',
                'kode_gedung' => 'F-C',
                'jumlah_lantai' => 1,
                'deskripsi_lokasi' => 'Pusat kegiatan mahasiswa',
                'is_aktif' => true,
            ],
            [
                'nama_gedung' => 'Gedung D - Ruang Baca',
                'kode_gedung' => 'F-D',
                'jumlah_lantai' => 2,
                'deskripsi_lokasi' => 'Dekat dengan area parkir',
                'is_aktif' => true,
            ],
            [
                'nama_gedung' => 'Gedung E - Pusat Inovasi',
                'kode_gedung' => 'F-E',
                'jumlah_lantai' => 4,
                'deskripsi_lokasi' => 'Gedung baru lantai paling atas',
                'is_aktif' => false, // Contoh gedung yang belum beroperasi
            ],
            [
                'nama_gedung' => 'Gedung F - Dekanat',
                'kode_gedung' => 'F-F',
                'jumlah_lantai' => 3,
                'deskripsi_lokasi' => 'Pusat administrasi kampus',
                'is_aktif' => true,
            ],
        ];

        foreach ($dataGedung as $gedung) {
            Gedung::create($gedung);
        }
    }
}