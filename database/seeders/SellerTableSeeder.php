<?php

namespace Database\Seeders;

use App\Models\Seller;
use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::updateOrCreate([
            'name' => 'Avver',
            'email' => 'seller@example.com',
            'password' => Hash::make('12345678'),
        ]);

        Shop::updateOrCreate([
            'seller_id' => 1,
            'name' => 'Demo Shop',
            'logo' => 'https://cdn.dsmcdn.com/seller-store/uploads/130257/53d6103c-9f9a-4142-a34a-f95bb6ff0897.jpeg',
            'banner' => 'default.png',
            'address' => 'demo address',
            'facebook' => '#',
            'twitter' => '#',
            'google' => '#',
            'youtube' => '#',
            'slug' => 'demo-shop-h5fb7',
            'status' => 0,
            'meta_title' => 'lorem Ipsum',
            'meta_description' => 'lorem Ipsum',
            'pick_up_point_id' => '1',
            'shipping_cost' => 0,

            'category_id' => '1',
            'company_type' => 'Ecommerce',
            'tin' => '0245873DR',
            'country_id' => '223',
            'state_id' => '25',
            'reference_code' => 'BennebosMarket',
        ]);
    }
}
