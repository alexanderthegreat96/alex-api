<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trips>
 */
class TripsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->name,
            'slug' => Str::slug(fake()->name),
            'description' => fake()->text(150),
            'start_date' => date('Y-m-d'),
            'end_date' => fake()->dateTimeBetween('now', '+1 year'),
            'location' => fake()->address(),
            'price' => number_format(rand(1,300),'2','.',','),
        ];
    }
}
