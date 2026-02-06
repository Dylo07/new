<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->index();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('booking_id')->nullable()->constrained()->nullOnDelete();

            // Lead source & status
            $table->enum('source', ['package_builder', 'whatsapp', 'contact_form', 'phone', 'manual'])->default('package_builder');
            $table->enum('status', ['started', 'browsing', 'reviewed', 'paid', 'abandoned', 'converted'])->default('started');

            // Package interest data
            $table->string('category')->nullable();       // couple, family, group, wedding
            $table->string('package_type')->nullable();    // day_out, half_board, full_board
            $table->foreignId('custom_package_id')->nullable()->constrained()->nullOnDelete();
            $table->string('package_name')->nullable();

            // Guest & date info
            $table->integer('adults')->nullable();
            $table->integer('children')->nullable();
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->decimal('estimated_value', 10, 2)->nullable();

            // Contact info (for non-logged-in users)
            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();
            $table->string('guest_phone')->nullable();

            // Tracking
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('referrer_url')->nullable();
            $table->string('landing_page')->nullable();
            $table->string('device_type')->nullable();     // mobile, desktop, tablet
            $table->string('ip_address')->nullable();

            // Follow-up
            $table->text('staff_notes')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->timestamp('followed_up_at')->nullable();
            $table->string('followed_up_by')->nullable();

            $table->timestamps();

            // Indexes for dashboard queries
            $table->index('status');
            $table->index('source');
            $table->index('category');
            $table->index('created_at');
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
