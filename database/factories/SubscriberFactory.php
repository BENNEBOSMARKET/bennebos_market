<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberFactory extends Factory
{
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->email(),
            'status' => $this->faker->boolean(),
        ];
    }
}
