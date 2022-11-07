<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table = "sizes";
    protected $fillable = ['size','image','type_id'];

    public function productType()
    {
        return $this->belongsTo(ProductType::class,'type_id');
    }

}
