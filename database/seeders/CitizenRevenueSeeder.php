<?php

namespace Database\Seeders;

use App\Models\CitizenRevenue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitizenRevenueSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     *
     * @return void
     */
    public function run()
    {
        CitizenRevenue::truncate(); // Hapus data lama
        CitizenRevenue::factory(50)->create(); // Buat 50 data pendapatan warga
    }
}
