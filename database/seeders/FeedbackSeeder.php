<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('feedbacks')->delete(); // Clear existing feedback

        for ($i = 0; $i < 25; $i++) { // Create 25 feedback entries
            DB::table('feedbacks')->insert([
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'description' => $faker->paragraph(4),
                'created_at' => now()->subDays($faker->numberBetween(0, 60)),
                'updated_at' => now()->subDays($faker->numberBetween(0, 5)),
                'created_by' => $faker->randomElement(DB::table('users')->pluck('id')->toArray()), // Assuming feedbacks are created by users
            ]);
        }
    }
}