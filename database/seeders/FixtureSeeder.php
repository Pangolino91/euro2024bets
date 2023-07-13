<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Fixture;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class FixtureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['name' => 'Admin', 'email' => 'admin@euro2024.com', 'password' => bcrypt('Pass@word1'), 'is_admin' => 1]);
    }
}
