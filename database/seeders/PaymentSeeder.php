<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        DB::table('payments')->delete(); // Clear existing payments

        // Get booths that have been assigned a user (i.e., rented booths)
        $rentedBooths = DB::table('booths')->whereNotNull('user_id')->select('id', 'user_id', 'price')->get();

        if ($rentedBooths->isEmpty()) {
            $this->command->warn('No rented booths found. Skipping PaymentSeeder.');
            return;
        }

        // $paymentMethods = ['Credit Card', 'Online Banking', 'E-Wallet'];
        // $statuses = ['completed', 'pending', 'failed']; // Match migration enum

        foreach ($rentedBooths as $booth) {
            // Decide payment status (e.g., 85% completed)
             $status = $faker->randomElement(array_merge(
                array_fill(0, 17, 'completed'), // Higher chance for completed
                array_fill(0, 2, 'pending'),
                array_fill(0, 1, 'failed')
             ));

            DB::table('payments')->insert([
                'amount' => $booth->price, // Amount matches the booth price
                'user_id' => $booth->user_id, // The user who rented the booth pays
                'booth_id' => $booth->id, // The specific booth being paid for
                'transaction_id' => $status === 'completed' ? 'txn_' . Str::random(12) : null, // Only completed have IDs usually
                // 'payment_method' => $faker->randomElement($paymentMethods),
                // 'status' => $status,
                'created_at' => now()->subDays($faker->numberBetween(1, 80)),
                'updated_at' => now()->subDays($faker->numberBetween(0, 2)),
            ]);
        }
    }
}