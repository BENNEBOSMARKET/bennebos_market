<?php

namespace Database\Seeders;

use App\Models\BusinessSetting;
use Illuminate\Database\Seeder;

class BusinessSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getData = BusinessSetting::find(1);
        if(!$getData){
            $data = new BusinessSetting();
            $data->refund_time = 7;
            $data->save();
        }
        
    }
}
