<?php

namespace App\Imports;

use App\Models\CompanyInfo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompanyInfoImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $getData = CompanyInfo::where('company_name', $row['company_name'])->first();

        if(!$getData){
            $social_count = count(json_decode(str_replace("'", '"',$row['social_media'])));

            $info = new CompanyInfo();
            $info->logo = $row['logo'];
            $info->company_name = $row['company_name'];
            $info->category = $row['category'];
            $info->mobile = $row['mobile'];
            $info->email = $row['email'];
            $info->website = $row['website'];
            $info->address = $row['address'];
            $info->country_id = '223';
            $info->social_media = $row['social_media'];
            $info->social_media_count = $social_count;
            $info->save();
        }
    }
}
