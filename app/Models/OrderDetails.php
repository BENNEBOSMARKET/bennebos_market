<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    protected $fillable = [
        "order_id",
        "seller_id",
        "product_id",
        "color",
        "size",
        "price",
        "quantity",
        "total",
    ];
 
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
