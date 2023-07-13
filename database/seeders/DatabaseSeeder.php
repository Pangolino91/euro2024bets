<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Fixture;
use \App\Models\Bet;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();
        Fixture::factory(4)->create();

        // run this AFTER running the fixtures factory
        // Bet::factory(5)->create();
    }
}
