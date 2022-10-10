<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryTranslation extends Model
{
    use HasFactory;

    protected $table = 'category_translations';
    protected $fillable = ['name', 'lang', 'category_id'];

    public function category(){
    	return $this->belongsTo(Category::class);
    }
}
