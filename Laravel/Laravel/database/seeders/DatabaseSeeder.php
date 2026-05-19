<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
public function run(): void
    {
        // Daftarkan seeder Anda di sini
        $this->call([
            GedungSeeder::class,
            // Jika nanti ada LokerSeeder, tambahkan di bawahnya
        ]);
    }
}