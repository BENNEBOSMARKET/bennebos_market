<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeRequest extends Model
{
    use HasFactory;

    protected $table = 'size_requests';
    protected $fillable = [
        "product_id",
        "user_id",
        "requested_sizes",
        "message",
    ];
    




}
