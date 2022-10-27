<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendMoneyCustomer extends Model
{
    use HasFactory;
    protected $table='send_money_customers';
    protected $guarded=[];
    public function customer()
    {
        return $this->belongsTo(User::class);
    }
}
