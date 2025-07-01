<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'transactionable_id',
        'transactionable_type',
        'type',
        'amount',
        'balance_after',
        'description',
        'status',
    ];

    /**
     * Get the user that owns the transaction.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * This is the polymorphic relationship.
     * It allows a transaction to belong to a Deposit, Withdrawal, Earning, etc.
     */
    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }
}