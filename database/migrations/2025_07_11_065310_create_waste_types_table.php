<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Membuat tabel 'waste_types' untuk menyimpan jenis-jenis sampah (Organik, Anorganik, dll.).
     */
    public function up(): void
    {
        Schema::create('waste_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nama jenis sampah (misal: Organik, Anorganik)
            $table->string('description')->nullable();
             $table->string('image')->nullable();// Deskripsi opsional
            $table->string('unit_of_weight')->default('kg'); // Satuan berat default (misal: kg, gram)
            $table->timestamps();
        });
    }

    /**
     * Balikkan migrasi.
     * Menghapus tabel 'waste_types'.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_types');
    }
};
