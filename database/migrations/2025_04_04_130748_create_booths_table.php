<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoothsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booths', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->text('description')->nullable(); 
            $table->decimal('price', 8, 2); // Price with 8 total digits and 2 decimal places

            // Foreign key for the event this booth belongs to
            $table->foreignId('event_id')->constrained('events');

            // Foreign key for the user who has booked/rented the booth (likely a requester)
            // Making it nullable allows booths to exist before being booked.
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Corresponds to 'user id fk' referencing users table. Set null on user deletion.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booths');
    }
}
