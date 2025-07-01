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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // --- COLUMNS SPECIFIC TO A WITHDRAWAL ---

            // The method chosen: 'btc' or 'bank'
            $table->string('method'); 

            // The destination BTC address, if applicable.
            $table->string('wallet_address')->nullable(); 

            // The destination bank details, if applicable. Stored as JSON.
            $table->json('bank_details')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};