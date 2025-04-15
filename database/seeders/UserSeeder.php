<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // will be implemented for hashing password
use Illuminate\Support\Str;
use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('ms_MY'); //Check for Malaysia refers: https://fakerphp.org/locales/ms_MY/
        DB::table('users')->delete(); // Clear existing users

        // Create a default admin user
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Str::random(8),
            'role' => 'admin',
            'phone' => $faker->voipNumber, // example: "015-458 7099"
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create organisers
        for ($i = 0; $i < 20; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name('male') . ' (Organiser)', // Indicate role in name for clarity
                'email' => $faker->unique()->safeEmail,
                'password' => Str::random(8),
                'role' => 'organiser',
                'phone' => $faker->voipNumber,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create requesters (potential booth renters)
        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name . ' (Requester)',
                'email' => $faker->unique()->safeEmail,
                'password' => Str::random(8),
                'role' => 'requester',
                'phone' => $faker->voipNumber,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}