<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table = 'product_details';
    protected $fillable = [
        "name",
        "slug",
        "title",
        "description",
        "images",
        "thumbnail",
        "color_id",
        "size_id",
        "seller_id",
        "product_id",
        "price",
    ];


    public function size(){
        return $this->belongsTo(Size::class);
    }
    public function color(){
        return $this->belongsTo(Color::class);
    }
}
