<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Waste;

class WasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wastes = [
            [
                'name' => 'Botol Plastik',
                'points_per_kg' => 5000,
                'description' => 'Botol plastik bekas minuman dalam kondisi bersih',
                'is_active' => true,
            ],
            [
                'name' => 'Kardus',
                'points_per_kg' => 3000,
                'description' => 'Kardus bekas dalam kondisi bersih dan kering',
                'is_active' => true,
            ],
            [
                'name' => 'Kertas',
                'points_per_kg' => 2500,
                'description' => 'Kertas bekas, koran, majalah dalam kondisi kering',
                'is_active' => true,
            ],
            [
                'name' => 'Kaleng Aluminium',
                'points_per_kg' => 15000,
                'description' => 'Kaleng minuman aluminium dalam kondisi bersih',
                'is_active' => true,
            ],
            [
                'name' => 'Botol Kaca',
                'points_per_kg' => 1000,
                'description' => 'Botol kaca bekas dalam kondisi utuh',
                'is_active' => true,
            ],
        ];

        foreach ($wastes as $waste) {
            Waste::create($waste);
        }
    }
}