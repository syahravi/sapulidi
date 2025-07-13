<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Membuat tabel 'sorted_waste' untuk mencatat sampah yang sudah disortir.
     */
    public function up(): void
    {
        Schema::create('sorted_waste', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waste_type_id')->constrained('waste_types')->onDelete('cascade'); // Foreign key ke jenis sampah
            $table->decimal('weight', 8, 2); // Berat sampah yang disortir
            $table->date('sorting_date'); // Tanggal sortir
            $table->enum('status', ['dijual', 'dibuang']); // Status sampah: bisa dijual atau dibuang
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Balikkan migrasi.
     * Menghapus tabel 'sorted_waste'.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorted_waste');
    }
};
