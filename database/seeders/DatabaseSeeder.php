<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Qutotation;
use App\Models\QutotationCategory;
use App\Models\Review;
use App\Models\Shop;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Category::factory(10)->create();
        // Product::factory(25)->create();
        // Color::factory(25)->create();
        // Brand::factory(25)->create();
        // Subscriber::factory(15)->create();
        // Shop::factory(20)->create();
        // WishList::factory(25)->create();
        // Review::factory(500)->create();
        // User::factory(50)->create();
        // Qutotation::factory(50)->create();
        // QutotationCategory::factory(50)->create();
        // Cart::factory(10)->create();
        $this->call(AdminTableSeeder::class);
        $this->call(SellerTableSeeder::class);
        $this->call(WebsiteSettingTableSeeder::class);
        // $this->call(ESliderSeeder::class);

        // Order::factory(10)->create();
        // OrderDetails::factory(20)->create();
        // $this->call(BusinessSettingTableSeeder::class);
    }
}
