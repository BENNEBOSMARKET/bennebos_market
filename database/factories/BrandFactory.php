<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $brand_name = $this->faker->unique(true)->words($nb=2, $asText=true);
        $slug = Str::slug($brand_name);

        return [
            'name' => $brand_name,
            'category_id' => '[]',
            'slug' => $slug,
            'logo' => 'logo_' . $this->faker->unique(true)->numberBetween(1, 10).'.png',
            'meta_title' => $this->faker->text(200),
            'meta_description' => $this->faker->text(500),
            'top' => $this->faker->boolean(),
            'status' => $this->faker->boolean(),
        ];
    }
}
