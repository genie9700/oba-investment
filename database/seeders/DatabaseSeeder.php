<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'is_admin' => true,
        ]);
        
        User::factory()->create([
            'name' => 'austine mathias',
            'email' => 'austinemathias9@gmail.com',
            'is_admin' => false,
        ]);

        $this->call([
            PlanSeeder::class,
            PaymentMethodSeeder::class,
        ]);
    }
}