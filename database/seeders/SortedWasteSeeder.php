<?php

namespace Database\Seeders;

use App\Models\SortedWaste;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SortedWasteSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     *
     * @return void
     */
    public function run()
    {
        SortedWaste::truncate(); // Hapus data lama
        SortedWaste::factory(50)->create(); // Buat 50 data sampah sortir
    }
}
