<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use TarfinLabs\LaravelSpatial\Types\Point;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TripHistory>
 */
class TripHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'rider_id' => 2,
            'keke_id' => fake()->unique()->numerify('Keke-####'),
            'status' => 0,
            'start_trip_time' => Carbon::now(),
            'start_location' => new Point(lat: fake()->latitude($min = -90, $max = 90), lng: fake()->latitude($min = -90, $max = 90)),
            'current_location' => new Point(lat: fake()->latitude($min = -90, $max = 90), lng: fake()->latitude($min = -90, $max = 90)),
            'end_trip_time' => Carbon::now(),
            'end_location' => new Point(lat: fake()->latitude($min = -90, $max = 90), lng: fake()->latitude($min = -90, $max = 90)),
        ];
    }
}
