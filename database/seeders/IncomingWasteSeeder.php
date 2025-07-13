<?php

namespace Database\Seeders;

use App\Models\IncomingWaste;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomingWasteSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     *
     * @return void
     */
    public function run()
    {
        IncomingWaste::truncate(); // Hapus data lama
        IncomingWaste::factory(50)->create(); // Buat 50 data sampah masuk
    }
}
