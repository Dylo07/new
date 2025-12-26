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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('status'); // 'card' or 'bank_transfer'
            $table->string('payment_receipt')->nullable()->after('payment_method'); // Path to uploaded receipt
            $table->string('payment_status')->default('pending')->after('payment_receipt'); // 'pending', 'uploaded', 'verified'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_receipt', 'payment_status']);
        });
    }
};
