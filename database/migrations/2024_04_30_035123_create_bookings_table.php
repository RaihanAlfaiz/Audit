<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id'); // Change the data type to string
            $table->foreign('event_id')->references('id')->on('events')->onDelete('CASCADE'); // Menambahkan onDelete('CASCADE')
            $table->string('total_payment');
            $table->string('ktp');
            $table->string('receipt_full');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
