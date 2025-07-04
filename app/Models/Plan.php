<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'hash_power',
        'daily_earning_rate',
        'duration_in_months',
        'withdrawal_limit',
        'tier',
        'is_featured',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'float',
        'daily_earning_rate' => 'float',
    ];


    /**
     * Appending these accessors ensures they are included when the model is
     * converted to an array or JSON, making them easily accessible in Livewire.
     */
    protected $appends = ['total_return', 'roi_percentage'];

    /**
     * Accessor to calculate the total projected return for the plan.
     */
    public function getTotalReturnAttribute(): float
    {
        $days = $this->duration_in_months * 30.4;
        return $this->daily_earning_rate * $days;
    }

    /**
     * Accessor to calculate the Return on Investment (ROI) percentage.
     */
    public function getRoiPercentageAttribute(): float
    {
        if ($this->price <= 0) {
            return 0;
        }
        return ($this->total_return / $this->price) * 100;
    }

}