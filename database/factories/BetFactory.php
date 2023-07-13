<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Bet;
use App\Models\Fixture;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bet>
 */
class BetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prediction = $this->faker->randomElement(['home', 'draw', 'away']);

        $user = User::where('is_admin', false)->inRandomOrder()->first();

        if (!$user) {
            $user = User::factory()->create();
        }


        $fixture = Fixture::inRandomOrder()->first();
        $correct = $fixture->result === $prediction ? true : false;
        return [
            'user_id' => $user->id,
            'fixture_id' => $fixture->id,
            'prediction' => $prediction,
            'correct' => $correct,
        ];
    }
}
