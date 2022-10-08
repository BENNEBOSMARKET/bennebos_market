<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';
    protected $fillable =  ['seller_id', 'logo', 'verification_status', 'name', 'slug', 'address', 'category_id']; 
}
