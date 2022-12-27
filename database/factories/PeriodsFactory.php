<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PeriodsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "label" => "2023A",
            "start_date" => $this->faker->date('Y-m-d'),
            "end_date" => $this->faker->date('Y-m-d')
        ];
    }
}
