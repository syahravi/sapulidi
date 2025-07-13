<?php

namespace Database\Factories;

use App\Models\SortedWaste;
use App\Models\WasteType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SortedWasteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SortedWaste::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $wasteType = WasteType::inRandomOrder()->first();
        if (!$wasteType) {
            $wasteType = WasteType::factory()->create();
        }

        return [
            'waste_type_id' => $wasteType->id,
            'weight' => $this->faker->randomFloat(2, 0.1, 20), // Berat antara 0.10 hingga 20.00 kg
            'sorting_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['dijual', 'dibuang']),
        ];
    }
}
