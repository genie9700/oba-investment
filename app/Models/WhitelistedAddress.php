<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WhitelistedAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'label',
        'method',
        'address',
        'bank_details',
    ];

    protected $casts = [
        'bank_details' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}