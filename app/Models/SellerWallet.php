<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerWallet extends Model
{
    use HasFactory;

    protected $table = 'seller_wallets';
    protected $fillable = ['seller_id'];
}
