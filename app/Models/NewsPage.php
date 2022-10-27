<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsPage extends Model
{
    use HasFactory;
    protected $table='news_pages';
    protected $guarded=[];
}
