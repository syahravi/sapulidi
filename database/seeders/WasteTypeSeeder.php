<?php

namespace Database\Seeders;

use App\Models\WasteType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import DB facade

class WasteTypeSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menonaktifkan pemeriksaan foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus semua data yang ada untuk menghindari duplikasi saat seeding ulang
        WasteType::truncate();

        // Mengaktifkan kembali pemeriksaan foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Buat beberapa jenis sampah dasar secara eksplisit
        WasteType::create(['name' => 'Organik', 'description' => 'Sampah sisa makanan, daun, dll.', 'unit_of_weight' => 'kg']);
        WasteType::create(['name' => 'Plastik PET', 'description' => 'Botol plastik bening, dll.', 'unit_of_weight' => 'kg']);
        WasteType::create(['name' => 'Kertas', 'description' => 'Kertas bekas, kardus, dll.', 'unit_of_weight' => 'kg']);
        WasteType::create(['name' => 'Kaca', 'description' => 'Botol kaca, pecahan kaca, dll.', 'unit_of_weight' => 'kg']);
        WasteType::create(['name' => 'Logam', 'description' => 'Kaleng, besi, aluminium, dll.', 'unit_of_weight' => 'kg']);
    }
}
