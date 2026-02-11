<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('custom_packages', function (Blueprint $table) {
            $table->decimal('single_price', 10, 2)->nullable()->after('adult_price');
        });
    }

    public function down(): void
    {
        Schema::table('custom_packages', function (Blueprint $table) {
            $table->dropColumn('single_price');
        });
    }
};
