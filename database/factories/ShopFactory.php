<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    public function definition()
    {
        $shop_name = $this->faker->unique(true)->words($nb=4, $asText=true);
        $slug = Str::slug($shop_name);

        return [
            'seller_id' => $this->faker->numberBetween(1, 10),
            'name' => $shop_name,
            'logo' => 'shop_' . $this->faker->unique(true)->numberBetween(1, 10).'.png',
            'banner' => 'shop_banner_' . $this->faker->unique(true)->numberBetween(1, 10).'.png',
            'address' => $this->faker->text(5),
            'facebook' => $this->faker->text(5),
            'twitter' => $this->faker->text(5),
            'google' => $this->faker->text(5),
            'youtube' => $this->faker->text(5),
            'slug' => $slug,
            'status' => $this->faker->boolean(),
            'meta_title' => $this->faker->text(200),
            'meta_description' => $this->faker->text(500),
            'pick_up_point_id' => $this->faker->numberBetween(1, 10),
            'shipping_cost' => $this->faker->numberBetween(10, 400),
            'verification_status' => 1
        ];
    }
}
