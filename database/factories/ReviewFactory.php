<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'product_id' => $this->faker->numberBetween(1, 88),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->text(50),
            'status' => $this->faker->boolean(),
        ];
    }
}
