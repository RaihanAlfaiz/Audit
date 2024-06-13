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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages');
            $table->string('Institution_origin');
            $table->string('email')->nullable();
            $table->string('event_name');
            $table->string('phone');
            $table->string('capacity');
            $table->date('event_date');
            $table->string('tenant_name');
            $table->date('rehearsal_date')->nullable();
            $table->string('status')->nullable();
            $table->string('receipt_dp')->nullable();
            $table->string('start_time');
            $table->string('end_time');
            $table->float('dp_amount', 10)->nullable();
            $table->float('remaining_payment', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
