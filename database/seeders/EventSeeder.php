<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('events')->delete(); // Clear existing events

        // Get IDs of organizers/admins to assign as creators
        $organizerIds = DB::table('users')->whereIn('role', 'organizer')->pluck('id')->toArray();

        if (empty($organizerIds)) {
            $this->command->warn('No organizer users found. Skipping EventSeeder.');
            return;
        }

        $statuses = ['ongoing', 'canceled', 'unlisted', 'upcoming'];
        $categories = ['Tech Expo', 'Food Fair', 'Music Festival', 'Art Show', 'Career Fair', 'Community Market'];
        $locations = ['Butterworth Arena', 'Penang Convention Centre', 'Spice Arena', 'Straits Quay', 'Local Community Hall'];


        for ($i = 0; $i < 15; $i++) { // Create 15 events
            $startDate = Carbon::instance($faker->dateTimeBetween('+1 week', '+3 months'));
            $endDate = (clone $startDate)->addDays($faker->numberBetween(0, 5)); // Event duration 1 to 6 days

            DB::table('events')->insert([
                'name' => $faker->company . ' ' . $faker->randomElement(['Expo', 'Fair', 'Fest', 'Showcase']),
                'description' => $faker->paragraph(3),
                'status' => $faker->randomElement($statuses),
                'img' => $faker->imageUrl(640, 480, 'business', true), // Placeholder image
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'start_time' => $faker->time('H:i:s', '10:00:00'),
                'end_time' => $faker->time('H:i:s', '22:00:00'),
                'location' => $faker->randomElement($locations) . ', ' . $faker->city . ', Penang', // Add some local context
                'category' => $faker->randomElement($categories),
                'booth_quantity' => $faker->numberBetween(10, 50),
                'user_id' => $faker->randomElement($organizerIds), // Assign a random organizer
                'created_at' => now()->subDays($faker->numberBetween(5, 100)),
                'updated_at' => now()->subDays($faker->numberBetween(0, 4)),
            ]);
        }
    }
}