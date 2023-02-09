<?php

namespace Database\Factories;

use App\Models\Keke;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Keke>
 */
class KekeFactory extends Factory
{
    protected $model = Keke::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'plate_no' => fake()->unique()->numerify('Keke-####'),
            'color' => fake()->colorName(),
            'rider_id' => fake()->randomDigitNotNull(),
        ];
    }
}
