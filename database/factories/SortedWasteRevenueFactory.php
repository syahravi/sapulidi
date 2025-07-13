<?php

namespace Database\Factories;

use App\Models\SortedWasteRevenue;
use App\Models\WasteType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SortedWasteRevenueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SortedWasteRevenue::class;

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

        $soldWeight = $this->faker->randomFloat(2, 0.5, 15); // Berat dijual antara 0.50 hingga 15.00 kg
        $amountReceived = $soldWeight * $this->faker->randomFloat(2, 5000, 20000); // Harga per kg antara 5000-20000

        return [
            'waste_type_id' => $wasteType->id,
            'sold_weight' => $soldWeight,
            'amount_received' => $amountReceived,
            'sale_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }
}
