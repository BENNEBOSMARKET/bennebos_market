<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        $product_name = $this->faker->unique(true)->words($nb=4, $asText=true);
        $slug = Str::slug($product_name);

        return [
            'name' => $product_name,
            'slug' => $slug,
            'category_id' => $this->faker->numberBetween(1, 10),
            'brand_id' => $this->faker->numberBetween(1, 10),
            'unit' => Str::random(5),
            'min_qty' => $this->faker->numberBetween(5, 15),
            'barcode' => $this->faker->text(5),
            'refundable' => $this->faker->boolean(),
            'thumbnail' => 'product_' . $this->faker->unique(true)->numberBetween(1, 25).'.png',
            'video' => $this->faker->text(5),
            'unit_price' => $this->faker->numberBetween(10, 400),
            'discount_date_from' => $this->faker->date(),
            'discount_date_to' => $this->faker->date(),
            'discount' => $this->faker->numberBetween(1, 10),
            'quantity' => $this->faker->numberBetween(500, 1000),
            'sku' => $this->faker->text(5),
            'meta_title' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'meta_description' => $this->faker->text(500),
            'featured' => $this->faker->boolean(),
            'status' => $this->faker->boolean(),
            'color' => json_encode([]),
            'size' => json_encode([]),
            'total_review' => $this->faker->numberBetween(1, 7),
            'avg_review' => $this->faker->numberBetween(1, 5),
            'user_id' => $this->faker->numberBetween(0, 1),
            'added_by' => 'admin',
        ];
    }
}
