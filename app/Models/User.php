<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Deposit;
use App\Models\Earning;
use App\Models\Investment;
use App\Models\Withdrawal;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'password',
        'avatar_url',
        'balance',
        'is_suspended',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     /**
     * A user can have many transactions.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class)->latest(); // Order by most recent
    }

    /**
     * A user can have many investments.
     */
    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class)->latest();
    }

    /**
     * A user can have many deposits.
     */
    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class)->latest();
    }

    /**
     * A user can have many withdrawals.
     */
    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class)->latest();
    }
    
    /**
     * A user can have many earnings.
     */
    public function earnings(): HasMany
    {
        return $this->hasMany(Earning::class)->latest();
    }

    /**
     * Get the user's whitelisted addresses.
     */
    public function whitelistedAddresses(): HasMany
    {
        return $this->hasMany(WhitelistedAddress::class)->latest();
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}