<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $guarded = [];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function product_size()
    {
        return $this->belongsTo(Size::class, 'size');
    }

    public function product_color()
    {
        return $this->belongsTo(Color::class, 'color');
    }

}
