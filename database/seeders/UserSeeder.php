<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This method contains the logic to create 50 random users to test the database correct functioning.
     */
    public function run()
{
    $faker = Faker::create();

    for ($i = 0; $i < 50; $i++) {
        User::create([
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt('password123'),
            'phone_number' => $faker->phoneNumber,
        ]);
    }
}
}
