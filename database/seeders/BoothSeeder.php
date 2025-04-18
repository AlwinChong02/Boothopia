<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class BoothSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('booths')->delete(); // Clear existing booths

        $eventIds = DB::table('events')->pluck('id')->toArray();
        // Get IDs of requesters who might rent booths
        $requesterIds = DB::table('users')->where('role', 'requester')->pluck('id')->toArray();

        if (empty($eventIds)) {
             $this->command->warn('No events found. Skipping BoothSeeder.');
             return;
        }

        foreach ($eventIds as $eventId) {
            $boothQuantity = DB::table('events')->where('id', $eventId)->value('booth_quantity');
            $eventLocation = DB::table('events')->where('id', $eventId)->value('location');

            for ($i = 1; $i <= $boothQuantity; $i++) {
                // Decide if this booth is rented (e.g., 70% chance)
                $isRented = !empty($requesterIds) && $faker->boolean(70);

                DB::table('booths')->insert([
                    'name' => Str::random(10) . ' Booth ' . $i,
                    'description' => $faker->sentence,
                    'event_id' => $eventId,
                    'price' => $faker->randomFloat(2, 50, 500), // Price between 50.00 and 500.00

                    // Assign a requester ID if rented, otherwise null
                    'user_id' => $isRented ? $faker->randomElement($requesterIds) : null,
                    'created_at' => now()->subDays($faker->numberBetween(5, 90)),
                    'updated_at' => now()->subDays($faker->numberBetween(0, 4)),
                ]);
            }
        }
    }
}