<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition()
    {
        $category_name = $this->faker->unique()->words($nb=2, $asText=true);
        $slug = Str::slug($category_name);

        return [
            'name' => $category_name,
            'slug' => $slug,
            'commision_rate' => $this->faker->numberBetween(10, 500),
            'banner' => 'category_' . $this->faker->numberBetween(1, 10).'.png',
            'featured' => $this->faker->boolean(),
            'meta_title' => $this->faker->text(200),
            'meta_description' => $this->faker->text(500),
        ];
    }
}
