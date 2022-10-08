<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::all()->random();
            },
            'product_id' => function () {
                return Product::all()->random();
            },
            'price' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
