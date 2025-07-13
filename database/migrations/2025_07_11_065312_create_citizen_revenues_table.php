<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Membuat tabel 'citizen_revenues' untuk mencatat pendapatan dari warga.
     */
    public function up(): void
    {
        Schema::create('citizen_revenues', function (Blueprint $table) {
            $table->id();
            $table->string('citizen_name'); // Nama warga
            $table->decimal('waste_weight', 8, 2); // Berat sampah yang diserahkan warga
            $table->decimal('amount_paid', 10, 2); // Jumlah uang yang dibayarkan ke warga
            $table->date('transaction_date'); // Tanggal transaksi
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Balikkan migrasi.
     * Menghapus tabel 'citizen_revenues'.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizen_revenues');
    }
};
