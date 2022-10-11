<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        "user_id",
        "seller_id",
        "address_id",
        "delivery_status",
        "payment_type",
        "code",
        "grand_total",
        "discount",
        "date",
        "payment_status",
        "order_status"
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }


    public function orderProducts()
    {
        return $this->hasMany(OrderDetails::class, 'order_id')->with('products');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
