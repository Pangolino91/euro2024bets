<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fixture>
 */
class FixtureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $now = \Carbon\Carbon::now();
        $startDateTime = $now->copy()->addHours(0.40);
        $endDateTime = $now->copy()->addHours(1);
        $randomDateTime = $this->faker->dateTimeBetween($startDateTime, $endDateTime);

        // dd($randomDateTime);
        return [
            'home_team' => $this->faker->city,
            'away_team' => $this->faker->city,
            'kickoff' => $randomDateTime,
            'result' => 'pending',
        ];
    }
}
