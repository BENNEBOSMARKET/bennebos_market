<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'parent_id',
        'sub_parent_id',
        'name',
        'slug',
        'commision_rate',
        'banner',
    ];
    
    
    public function getsubSubCategory()
    {
        return $this->hasMany(Category::class, 'sub_parent_id');
    }


    public function subCategory()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->where('parent_id', '!=', 0)
            ->where('sub_parent_id', 0);
    }


    public function subSubCategory()
    {
        return $this->hasMany(Category::class, 'sub_parent_id')
            ->where('sub_parent_id', '!=', 0)
            ->where('parent_id', '!=', 0);
    }


    public function products(){
        return $this->hasMany(Product::class,"category_id");
    }
    public function sliders(){
        return $this->hasMany(Slider::class,"category_id");
    }

}
