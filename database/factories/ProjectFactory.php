<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words('2', true),
            'description' => $this->faker->paragraphs('3', true),
            'latitude' => $this->faker->randomFloat(6, 5.0, 19.0),    // 6 decimal places
            'longitude' => $this->faker->randomFloat(6, 115.0, 126.0),
            'dateStart' => $this->faker->date(),
            'status' => '0',
        ];
    }
}
