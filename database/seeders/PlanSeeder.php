<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Professional Plan', 
                'price' => 5000, 
                'hash_power' => '50 TH/s', 
                'daily_earning_rate' => 25, 
                'duration_in_months' => 12, 
                'withdrawal_limit' => 'Weekly', 
                'is_featured' => false, 
                'tier' => 'pro'
            ],
            [
                'name' => 'Elite Plan', 
                'price' => 25000, 
                'hash_power' => '260 TH/s', 
                'daily_earning_rate' => 135, 
                'duration_in_months' => 18, 
                'withdrawal_limit' => 'Every 3 Days', 
                'is_featured' => true, 
                'tier' => 'pro'
            ],
            [
                'name' => 'Apex Plan', 
                'price' => 100000, 
                'hash_power' => '1.1 PH/s', 
                'daily_earning_rate' => 550, 
                'duration_in_months' => 24, 
                'withdrawal_limit' => 'Daily', 
                'is_featured' => false, 
                'tier' => 'elite'
            ],
            [
                'name' => 'Sovereign Plan', 
                'price' => 500000, 
                'hash_power' => '5.8 PH/s', 
                'daily_earning_rate' => 2900, 
                'duration_in_months' => 24, 
                'withdrawal_limit' => 'Daily Priority', 
                'is_featured' => false, 
                'tier' => 'elite'
            ], 
            [
                'name' => 'Institutional Plan', 
                'price' => 1000000, 
                'hash_power' => '12 PH/s', 
                'daily_earning_rate' => 6200, 
                'duration_in_months' => 36, 
                'withdrawal_limit' => 'Dedicated OTC', 
                'is_featured' => false, 
                'tier' => 'institutional'
            ]
        ];

        foreach ($plans as $plan) {
            Plan::updateOrCreate(['name' => $plan['name']], $plan);
        }
    }
}