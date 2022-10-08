<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WishListFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'product_id' => $this->faker->numberBetween(1, 10),
            'heart' => $this->faker->boolean(),
        ];
    }
}
