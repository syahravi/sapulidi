<?php

namespace Database\Factories;

use App\Models\WasteType;
use Illuminate\Database\Eloquent\Factories\Factory;

class WasteTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WasteType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Daftar jenis sampah yang umum
        $wasteTypes = ['Organik', 'Plastik PET', 'Kertas', 'Kaca', 'Logam', 'Kardus', 'Karet', 'Tekstil', 'Baterai', 'Elektronik'];

        // Pilih nama dasar secara acak (bisa berulang)
        $baseName = $this->faker->randomElement($wasteTypes);

        // Buat sufiks angka yang unik untuk memastikan nama keseluruhan unik.
        // Menggunakan randomNumber(4) memberikan 10.000 kemungkinan (0000-9999),
        // yang lebih dari cukup untuk 45 data unik tambahan.
        $uniqueSuffix = $this->faker->unique()->randomNumber(4);

        return [
            'name' => $baseName . ' - ' . $uniqueSuffix, // Gabungkan nama dasar dengan sufiks unik
            'description' => $this->faker->sentence(),
            'unit_of_weight' => $this->faker->randomElement(['kg', 'gram']),
        ];
    }
}
