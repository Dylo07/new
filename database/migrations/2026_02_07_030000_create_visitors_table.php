<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->index();
            $table->string('country')->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('city')->nullable();
            $table->string('url')->nullable();
            $table->string('page_name')->nullable();
            $table->string('device_type', 20)->nullable();
            $table->string('browser', 50)->nullable();
            $table->string('platform', 50)->nullable();
            $table->string('referrer')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();

            $table->index('created_at');
            $table->index('country_code');
            $table->index(['country_code', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
