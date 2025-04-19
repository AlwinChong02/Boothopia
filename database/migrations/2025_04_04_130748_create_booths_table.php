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
            $table->decimal('price', 8, 2);
            $table->foreignId('event_id')->constrained('events','id')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users','id')->onDelete('set null');

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
