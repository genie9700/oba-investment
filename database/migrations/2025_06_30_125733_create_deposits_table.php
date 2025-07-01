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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            
            // We still keep user_id here for easy direct queries on deposits.
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            // --- COLUMNS SPECIFIC TO A DEPOSIT ---

            // The method used, e.g., 'BTC', 'ETH', 'Bank Transfer'.
            $table->string('method'); 

            // The wallet address the user was instructed to send funds to.
            // Useful for auditing and tracking.
            $table->string('deposit_wallet_address');

            // The amount of cryptocurrency sent (if applicable).
            // High precision is needed for crypto values.
            $table->decimal('amount_crypto', 16, 8)->nullable();

            // The blockchain transaction ID/hash provided by the user.
            $table->string('transaction_hash')->nullable(); 

            // The path to the uploaded payment proof screenshot.
            $table->string('proof_path')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};