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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('transactionable'); // This creates `transactionable_id` and `transactionable_type`
            $table->string('type'); // 'deposit', 'withdrawal', 'earning', 'investment'
            $table->decimal('amount', 15, 2);
            $table->decimal('balance_after', 15, 2); // The user's balance after this transaction
            $table->string('description');
            $table->string('status')->default('completed');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};