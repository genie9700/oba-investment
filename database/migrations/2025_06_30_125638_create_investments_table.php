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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // --- COLUMNS DEFINING THE INVESTMENT CONTRACT ---
            
            $table->decimal('initial_amount', 15, 2); // The original amount invested
            $table->string('plan_name');
            $table->string('hash_power');
            $table->decimal('daily_earning_rate', 15, 2); // The daily USD amount this plan generates
            $table->integer('duration_in_months');
            $table->string('status')->default('active'); // 'active' or 'completed'
            $table->timestamp('expires_at'); // When the investment contract ends

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};