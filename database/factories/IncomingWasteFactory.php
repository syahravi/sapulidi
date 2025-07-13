<?php

namespace Database\Factories;

use App\Models\IncomingWaste;
use App\Models\WasteType;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomingWasteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IncomingWaste::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Pastikan ada WasteType yang tersedia di database
        $wasteType = WasteType::inRandomOrder()->first();
        if (!$wasteType) {
            // Jika tidak ada WasteType, buat satu atau lebih
            $wasteType = WasteType::factory()->create();
        }

        return [
            'waste_type_id' => $wasteType->id,
            'weight' => $this->faker->randomFloat(2, 0.5, 50), // Berat antara 0.50 hingga 50.00 kg
            'entry_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'), // Tanggal dalam 1 tahun terakhir
            'collector_name' => $this->faker->name(),
        ];
    }
}
