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
        Schema::table('item_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id')->after('id');
            $table->string('description')->after('booking_id');
            $table->boolean('status')->default(false)->after('description');

            // Foreign key constraint
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_lists', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
            $table->dropColumn('booking_id');
            $table->dropColumn('description');
            $table->dropColumn('status');
        });
    }
};
