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
        Schema::create('item_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id'); // Foreign key to bookings table
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->string('description'); // Description of the item
            $table->boolean('status')->default(false); // Status of the item, default is false (unchecked)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_lists');
    }
};
