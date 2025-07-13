<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Membuat tabel 'incoming_waste' untuk mencatat sampah yang masuk.
     */
    public function up(): void
    {
        Schema::create('incoming_waste', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waste_type_id')->constrained('waste_types')->onDelete('cascade'); // Foreign key ke jenis sampah
            $table->decimal('weight', 8, 2); // Berat sampah (misal: 10.50 kg)
            $table->date('entry_date'); // Tanggal sampah masuk
            $table->string('collector_name'); // Nama pengepul/pengumpul
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Balikkan migrasi.
     * Menghapus tabel 'incoming_waste'.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_waste');
    }
};
