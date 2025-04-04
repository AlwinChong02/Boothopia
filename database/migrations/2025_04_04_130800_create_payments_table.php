<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); 
            $table->decimal('amount', 8, 2);

            
            // Foreign key for the user making the payment
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Corresponds to 'user.id fk' referencing users table

            // Foreign key for the booth being paid for.
            $table->foreignId('booth_id')->constrained('booths')->onDelete('cascade');

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
        Schema::dropIfExists('payments');
    }
}
