<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $table = 'company_infos';

    protected $fillable = ['company_name', 'logo', 'category', 'sub_category', 'established', 'telephone', 'fax', 'mobile', 'email', 'website', 'zip_code', 'address', 'state_id', 'country_id', 'facebook', 'twitter', 'instragram', 'linkedin', 'social_media'];
}
