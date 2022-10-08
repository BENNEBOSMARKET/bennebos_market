<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['id', 'color_id', 'size_id', 'seller_id', 'added_by', 'user_id', 'name', 'category_id', 'brand_id', 'main_product_id', 'slug', 'unit', 'min_qty', 'barcode', 'refundable', 'thumbnail', 'video', 'color', 'color_image', 'size', 'unit_price', 'discount_date_from', 'discount_date_to', 'discount', 'quantity', 'sku', 'total_review', 'avg_review', 'description', 'meta_title', 'meta_description', 'featured', 'status', 'color_titles', 'color_prices', 'gallery_image'];


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class,"user_id");
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_size()
    {
        return $this->belongsTo(Size::class,'size_id');
    }
    public function product_color()
    {
        return $this->belongsTo(Color::class,'color_id');
    }

    public function relatedProducts()
    {
        return $this->hasMany(Product::class,'main_product_id','id')
            ->select(['id','size_id','color_id','main_product_id']);
    }

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class,'product_id','id');
    }

    public function wishlists()
    {
        $query = $this->hasMany(WishList::class, 'product_id', 'id');

        if (auth()->user()) {
            $query = $query->where('user_id', auth('api')->user()->id);
        }
        elseif (request()->hasHeader('device_token')) {
            $query = $query->where('device_token', request()->header('device_token'));
        }

        return $query;
    }
    public function getWishlistsCountAttribute(){
        return WishList::where("user_id",Auth::id())->where('product_id',$this->id)->count();
    }

    public function productFirstDetails()
    {
        return $this->hasMany(ProductDetail::class,'product_id','id')
            ->orderBy('id', 'ASC')
            ->limit(1);
    }

    public function scopeTranslate($query)
    {
        return $query->leftJoin('products_descriptions', function ($join) {
            $join->on('products.id', '=', 'products_descriptions.product_id');
        })
            ->leftJoin("items_languages", function ($join) {
                $join->on('items_languages.id', '=', 'products_descriptions.language_id');
            })
            ->where('items_languages.local', app()->getLocale());
    }

    public function scopeSelectOne($query){
        return $query->first([
            "products.slug",
            "products.unit_price",
            "products.unit_price",
            "products.category_id",
            "products.user_id",
            "products.id",
            "products_descriptions.name",
            "products.thumbnail",
            "products.min_qty",
            "products.brand_id",
            "products.gallery_image",
            "products.unit",
            "products.size",
            "products_descriptions.description",
            "products_descriptions.name",
            "products.discount",
            "products.color_titles",
            "products.color_prices",
            "products.total_review",
            "products.avg_review",
            "products.color",
            "products.color_image",
        ]);
    }
    public function scopeSelectAll($query){
        return $query->select([
            "products.slug",
            "products.unit_price",
            "products.category_id",
            "products.user_id",
            "products.total_review",
            "products.avg_review",
            "products.id",
            "products_descriptions.name",
            "products.thumbnail",
            "products.min_qty",
            "products.brand_id",
            "products.gallery_image",
            "products.unit",
            "products.size",
            "products_descriptions.description",
            "products_descriptions.name",
            "products.discount",
            "products.color_titles",
            "products.color_prices",
            "products.color",
            "products.color_image",
        ]);
    }


    public function scopeSelectSome($query){
        return $query->select([
            "products.unit_price",
            "products.id",
            "products.thumbnail",
            "products.unit",
            "products_descriptions.name",
            "products.discount",
        ]);
    }
    


}
