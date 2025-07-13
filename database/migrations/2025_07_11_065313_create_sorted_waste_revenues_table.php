<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Membuat tabel 'sorted_waste_revenues' untuk mencatat pendapatan dari penjualan sampah yang disortir.
     */
    public function up(): void
    {
        Schema::create('sorted_waste_revenues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waste_type_id')->constrained('waste_types')->onDelete('cascade'); // Foreign key ke jenis sampah
            $table->decimal('sold_weight', 8, 2); // Berat sampah yang dijual
            $table->decimal('amount_received', 10, 2); // Jumlah uang yang diterima dari penjualan
            $table->date('sale_date'); // Tanggal penjualan
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Balikkan migrasi.
     * Menghapus tabel 'sorted_waste_revenues'.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorted_waste_revenues');
    }
};
