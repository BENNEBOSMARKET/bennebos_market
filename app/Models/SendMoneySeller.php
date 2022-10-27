<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendMoneySeller extends Model
{
    use HasFactory;
    protected $table='send_money_sellers';
    protected $guarded=[];
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
