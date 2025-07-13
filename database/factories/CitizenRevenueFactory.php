<?php

namespace Database\Factories;

use App\Models\CitizenRevenue;
use Illuminate\Database\Eloquent\Factories\Factory;

class CitizenRevenueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CitizenRevenue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $wasteWeight = $this->faker->randomFloat(2, 1, 30); // Berat sampah antara 1.00 hingga 30.00 kg
        $amountPaid = $wasteWeight * $this->faker->randomFloat(2, 1000, 5000); // Harga per kg antara 1000-5000

        return [
            'citizen_name' => $this->faker->name(),
            'waste_weight' => $wasteWeight,
            'amount_paid' => $amountPaid,
            'transaction_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }
}
