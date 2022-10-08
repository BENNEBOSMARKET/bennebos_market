<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
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
            'seller_id' => function (){
                return Seller::all()->random();
            },
            'address_id' => function (){
                return Address::all()->random();
            },
            'shipping_address' => $this->faker->address(),
            'payment_type' => $this->faker->randomElement(['cash', 'online']),
            'payment_details' => $this->faker->text(),
            'grand_total' => $this->faker->randomFloat(2, 0, 100),
            'profit_margin' => $this->faker->randomFloat(2, 0, 100),
            'code' => Str::random(10),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
