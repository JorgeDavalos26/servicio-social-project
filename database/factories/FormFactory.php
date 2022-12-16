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
            'scholar_course' => $this->faker->randomElement(['Propedéutico', 'Nivelación']),
            "scholar_level" => $this->faker->randomElement(['Tecnólogo', 'Ingeniería']),
            "label" => "2023",
        ];
    }
}
