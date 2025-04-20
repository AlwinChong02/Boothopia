<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import DB facade
use Illuminate\Support\Facades\Schema; // Import Schema facade

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Temporarily disable foreign key checks for truncating
        Schema::disableForeignKeyConstraints();

        // Call seeders in order
        $this->call([
            UserSeeder::class,
            EventSeeder::class,
            BoothSeeder::class,
            PaymentSeeder::class, 
            FeedbackSeeder::class, 
            ApprovalSeeder::class, 
        ]);

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();

        $this->command->info('Database seeded successfully!');
    }
}