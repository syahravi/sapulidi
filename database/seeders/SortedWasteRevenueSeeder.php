<?php

namespace Database\Seeders;

use App\Models\SortedWasteRevenue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SortedWasteRevenueSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     *
     * @return void
     */
    public function run()
    {
        SortedWasteRevenue::truncate(); // Hapus data lama
        SortedWasteRevenue::factory(50)->create(); // Buat 50 data pendapatan sampah dijual
    }
}
