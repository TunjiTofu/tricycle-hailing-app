<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TarfinLabs\LaravelSpatial\Types\Point;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->streetName(),
            'coordinates' => new Point(lat: fake()->latitude($min = -90, $max = 90), lng: fake()->latitude($min = -90, $max = 90)),
            'status' => fake()->numberBetween(0, 1),
        ];
    }
}
