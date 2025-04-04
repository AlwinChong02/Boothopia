<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->enum('status', ['ongoing', 'canceled', 'unlisted', 'upcoming'])->default('upcoming'); // Added 'upcoming' as a likely status, set default
            $table->string('img')->nullable(); // Image path/URL, likely nullable
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('location');
            $table->string('category');
            $table->integer('booth_quantity')->unsigned(); // quantity cannot negative
            $table->timestamps();

            //Foreign key(s)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming booths belong to users
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
