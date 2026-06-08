<?php

namespace Database\Factories;

use App\Models\EducationMaterial;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class EducationMaterialFactory extends Factory
{
    protected $model = EducationMaterial::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
            'url' => $this->faker->url,
            'thumbnail' => $this->faker->imageUrl(640, 480),
            'is_featured' => $this->faker->boolean,
            'type' => $this->faker->randomElement(['article', 'video']),
        ];
    }
}