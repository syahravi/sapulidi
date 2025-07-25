<?php

namespace Database\Factories;

use App\Models\IncomingWaste;
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
        return [
            'bag_count' => $this->faker->numberBetween(1, 20), // Jumlah kantong antara 1 hingga 20
            'entry_date' => $this->faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d'), // Tanggal dalam 1 tahun terakhir
            'collector_name' => $this->faker->name(), // Gunakan ini untuk nama umum
        ];
    }
}
