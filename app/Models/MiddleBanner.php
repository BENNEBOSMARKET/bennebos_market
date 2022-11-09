<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiddleBanner extends Model
{
    use HasFactory;

    protected $table = 'middle_banners';
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
