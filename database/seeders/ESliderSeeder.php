<?php

namespace Database\Seeders;

use App\Models\ElectroniSlider;
use Illuminate\Database\Seeder;

class ESliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ElectroniSlider::updateOrCreate([
            'banner' => 'default.png',
        ]);
    }
}
