<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "description" => "",
            'type' => $this->faker->randomElement(['PROPEDEUTICO', 'NIVELACION']),
            "level" => $this->faker->randomElement(['TECNOLOGO', 'INGENIERIA']),
            "version" => "2023",
        ];
    }
}
