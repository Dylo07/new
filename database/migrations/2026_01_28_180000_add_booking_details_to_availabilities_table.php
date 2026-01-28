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
        Schema::table('availabilities', function (Blueprint $table) {
            $table->json('rooms')->nullable()->after('status');
            $table->string('function_type')->nullable()->after('rooms');
            $table->integer('guest_count')->nullable()->after('function_type');
            $table->integer('booking_id')->nullable()->after('guest_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('availabilities', function (Blueprint $table) {
            $table->dropColumn(['rooms', 'function_type', 'guest_count', 'booking_id']);
        });
    }
};
