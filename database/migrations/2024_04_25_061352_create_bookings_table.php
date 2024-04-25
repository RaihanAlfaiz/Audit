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
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->date('booking_date');
            $table->string('total_payment');
            $table->integer('payment_discount')->nullable();
            // $table->date('event_date');
            $table->string('include_tools');
            $table->string('total_include');
            $table->string('additional_tools_name');
            $table->date('total_additional_tools');
            $table->string('added_price');
            $table->string('transfer_proof');
            $table->string('payment_status');
            $table->date('confirmation_date')->nullable();
            $table->string('description')->nullable();
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
