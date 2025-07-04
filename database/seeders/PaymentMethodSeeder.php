<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;


class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Bitcoin',
                'ticker' => 'BTC',
                'wallet_address' => 'bc1qyn0wnafvyfp3e4p5h2ltxt4nhmpya0r02t69tx',
                'network_warning' => 'Send only Bitcoin (BTC) to this address. Sending any other asset will result in permanent loss.',
                'is_active' => true,
            ],
            [
                'name' => 'Ethereum',
                'ticker' => 'ETH (ERC20)',
                'wallet_address' => '0x069C650eba1Db2962b0f190399997ADE76605D59',
                'network_warning' => 'Send only Ethereum (ETH) on the ERC-20 network. Do not use other networks (e.g., BSC, Polygon).',
                'is_active' => true,
            ],
            [
                'name' => 'Tether (USDT)',
                'ticker' => 'USDT (TRC20)',
                'wallet_address' => 'TPwDEuPYTMkvJw79ygbvLM9ZjTknoZM4Qy',
                'network_warning' => 'Send only Tether (USDT) on the TRON (TRC20) network. Do not use other networks.',
                'is_active' => true,
            ],
        ];

        foreach ($methods as $method) {
            // Use updateOrCreate to avoid creating duplicates if you run the seeder again.
            PaymentMethod::updateOrCreate(['ticker' => $method['ticker']], $method);
        }
    }
}