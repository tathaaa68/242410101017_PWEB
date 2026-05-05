<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Tabel Master Gedung
        Schema::create('gedungs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gedung');
            $table->string('kode_gedung')->unique();
            $table->timestamps();
        });

        // Tabel Pivot (kode_gudang / gedung_loker)
        // Sesuai permintaan Anda untuk nama tabel pivot "kode_gudang"
        Schema::create('kode_gudang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loker_id')->constrained('lokers')->onDelete('cascade');
            $table->foreignId('gedung_id')->constrained('gedungs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('many_to_many_loker_gedung');
    }
};
