<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->colorName(),
            'code' => $this->faker->hexColor(),
            'status' => $this->faker->boolean(),
        ];
    }
}
