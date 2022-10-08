<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

class QutotationCategoryFactory extends Factory
{
    public function definition()
    {
        $name = $this->faker->unique(true)->words($nb=4, $asText=true);
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
        ];
    }
}
