<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    public function run()
    {
        $rewards = [
            [
                'points_required' => 100,
                'cash_value' => 10000,
                'description' => 'Tukar 100 poin dengan Rp 10.000',
                'is_active' => true
            ],
            [
                'points_required' => 500,
                'cash_value' => 50000,
                'description' => 'Tukar 500 poin dengan Rp 50.000',
                'is_active' => true
            ],
            [
                'points_required' => 1000,
                'cash_value' => 100000,
                'description' => 'Tukar 1000 poin dengan Rp 100.000',
                'is_active' => true
            ]
        ];

        foreach ($rewards as $reward) {
            Reward::create($reward);
        }
    }
}