<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WebsiteSetting::updateOrCreate([
            'header_logo' => 'default.png',
            'fav_icon' => 'default_fav.png',
            'footer_logo' => 'default_footer.png',
        ]);
    }
}
