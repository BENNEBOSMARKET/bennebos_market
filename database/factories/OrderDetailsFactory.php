<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => function (){
                return Order::all()->random();
            },
            'seller_id' => function (){
                return Seller::all()->random();
            },
            'product_id' => function (){
                return Product::all()->random();
            },
            'color' => $this->faker->colorName(),
            'variation' => $this->faker->text(),
            'size' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'tax' => $this->faker->randomFloat(2, 0, 100),
            'shipping_cost' => $this->faker->randomFloat(2, 0, 100),
            'quantity' => $this->faker->numberBetween(1, 10),
            'total' => $this->faker->randomFloat(2, 0, 100),
            'profit_margin' => $this->faker->randomFloat(2, 0, 100),
            'shipping_type' => $this->faker->text(),
        ];
    }
}
