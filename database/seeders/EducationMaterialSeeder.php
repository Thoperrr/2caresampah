<?php

namespace Database\Seeders;

use App\Models\EducationMaterial;
use Illuminate\Database\Seeder;

class EducationMaterialSeeder extends Seeder
{
    public function run()
    {
        $materials = [
            [
                'title' => 'Cara Memilah Sampah dengan Benar',
                'type' => 'article',
                'content' => 'Sampah harus dipilah menjadi beberapa kategori: organik, anorganik, dan B3...',
                'is_featured' => true
            ],
            [
                'title' => 'Tutorial Daur Ulang Plastik',
                'type' => 'video',
                'url' => 'https://www.youtube.com/watch?v=example1',
                'is_featured' => false
            ],
            [
                'title' => 'Dampak Sampah terhadap Lingkungan',
                'type' => 'article',
                'content' => 'Sampah yang tidak dikelola dengan baik dapat mencemari lingkungan...',
                'is_featured' => false
            ]
        ];

        foreach ($materials as $material) {
            EducationMaterial::create($material);
        }
    }
}