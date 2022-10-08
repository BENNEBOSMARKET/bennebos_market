<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

class QutotationFactory extends Factory
{
    public function definition()
    {
        $name = $this->faker->unique(true)->words($nb=4, $asText=true);
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
            'category_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 10),
            'sourcing' => $this->faker->text(5),
            'sourcing_type' => $this->faker->text(5),
            'quantity' => $this->faker->numberBetween(10, 100),
            'piece' => $this->faker->text(5),
            'max_budget' => $this->faker->numberBetween(10, 100),
            'trade_terms' => $this->faker->text(5),
            'curency' => $this->faker->text(5),
            'repitation' => $this->faker->text(5),
            'days' => $this->faker->numberBetween(10, 100),
            'duration' => $this->faker->text(5),
            'details' => $this->faker->text(500),
            'shipping_method' => $this->faker->text(5),
            'country' => $this->faker->numberBetween(1, 100),
            'lead_time' => $this->faker->numberBetween(10, 100),
            'payment_method' => $this->faker->text(5),
        ];
    }
}
