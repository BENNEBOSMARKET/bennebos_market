<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColorDescription;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Seller;
use App\Models\SellerWallet;
use App\Models\Shop;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ProductImportV2 implements  ToModel,WithHeadingRow
{
   /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $product_name = '';
        $product_size = '';
        $product_price = '';
        $product_thumbnail = '';
        $product_gallery = '';
        $product_description = '';
        $MainCategoryID = '';

        $product_name = json_decode($row['color_titles'])[0];
        $product_size = json_encode(json_decode($row['sizes'])[0]);
        $product_price = json_decode($row['color_prices'])[0];
        $product_thumbnail = json_decode($row['thumbnails'])[0];
        $product_gallery = json_decode($row['color_gallery_images'])[0];
        $product_description = json_decode($row['color_descriptions'])[0];

        if($product_price == 'None'){
            $product_price = 100;
        }
        else{
            $product_price = $product_price;
        }


        $mainCategory = json_decode($row['all_categories'])[0];
        if(!isset(json_decode($row['all_categories'])[1])){
            $subCategory = '';
        }
        else{
            $subCategory = json_decode($row['all_categories'])[1];
        }
        if(!isset(json_decode($row['all_categories'])[2])){
            $sSubCategory = '';
        }
        else{
            $sSubCategory = json_decode($row['all_categories'])[2];
        }

        $getMainCategory = Category::where('parent_id', 0)->where('sub_parent_id', 0)->where('name', $mainCategory)->first();

        if($getMainCategory != ''){
            if($subCategory != ''){
                $getSubCategory = Category::where('parent_id', $getMainCategory->id)->where('sub_parent_id', 0)->where('name', $subCategory)->first();

                if($getSubCategory != ''){
                    if($sSubCategory != ''){
                        $getSubSubCategory = Category::where('parent_id', $getMainCategory->id)->where('sub_parent_id', $getSubCategory->id)->where('name', $sSubCategory)->first();

                        if($getSubSubCategory != ''){
                            $category_id = $getSubSubCategory->id;
                        }
                        else{
                            $subSubCategory = new Category();
                            $subSubCategory->parent_id = $getMainCategory->id;
                            $subSubCategory->sub_parent_id = $getSubCategory->id;
                            $subSubCategory->name = $sSubCategory;
                            $subSubCategory->slug = Str::slug($sSubCategory) . '-' . Str::random(6);
                            $subSubCategory->commision_rate = 0;
                            $subSubCategory->banner = 'default_category.png';
                            $subSubCategory->save();
        
                            $category_id = $subSubCategory->id;
                        }
                    }
                    else{
                        $category_id = $getSubCategory->id;
                    }
                }
                else{
                    $subcategory = new Category();
                    $subcategory->parent_id = $getMainCategory->id;
                    $subcategory->sub_parent_id = 0;
                    $subcategory->name = $subCategory;
                    $subcategory->slug = Str::slug($subCategory) . '-' . Str::random(6);
                    $subcategory->commision_rate = 0;
                    $subcategory->banner = 'default_category.png';
                    $subcategory->save();
                    $category_id = $subcategory->id;

                    if($sSubCategory != ''){
                        $subSubCategory = new Category();
                        $subSubCategory->parent_id = $getMainCategory->id;
                        $subSubCategory->sub_parent_id = $subcategory->id;
                        $subSubCategory->name = $sSubCategory;
                        $subSubCategory->slug = Str::slug($sSubCategory) . '-' . Str::random(6);
                        $subSubCategory->commision_rate = 0;
                        $subSubCategory->banner = 'default_category.png';
                        $subSubCategory->save();
        
                        $category_id = $subSubCategory->id;
                    }
        
                }
            }
            else{
                $category_id = $getMainCategory->id;
            }
            $MainCategoryID = $getMainCategory->id;
        }
        else{
            $category = new Category();
            $category->parent_id = 0;
            $category->sub_parent_id = 0;
            $category->name = $mainCategory;
            $category->slug = Str::slug($mainCategory) . '-' . Str::random(6);
            $category->commision_rate = 0;
            $category->banner = 'default_category.png';
            $category->save();

            $category_id = $category->id;

            if($subCategory != ''){
                $subcategory = new Category();
                $subcategory->parent_id = $category->id;
                $subcategory->sub_parent_id = 0;
                $subcategory->name = $subCategory;
                $subcategory->slug = Str::slug($subCategory) . '-' . Str::random(6);
                $subcategory->commision_rate = 0;
                $subcategory->banner = 'default_category.png';
                $subcategory->save();
                
                $category_id = $subcategory->id;
            }

            if($sSubCategory != ''){
                $subSubCategory = new Category();
                $subSubCategory->parent_id = $category->id;
                $subSubCategory->sub_parent_id = $subcategory->id;
                $subSubCategory->name = $sSubCategory;
                $subSubCategory->slug = Str::slug($sSubCategory) . '-' . Str::random(6);
                $subSubCategory->commision_rate = 0;
                $subSubCategory->banner = 'default_category.png';
                $subSubCategory->save();

                $category_id = $subSubCategory->id;
            }

            $MainCategoryID = $category->id;
        }

        if($getMainCategory && $getSubCategory){
            foreach(json_decode($row['all_categories']) as $key => $sscat){
                if($key > 3){
                    $getC = Category::where('parent_id', $getMainCategory->id)->where('sub_parent_id', $getSubCategory->id)->where('name', json_decode($row['all_categories'])[$key])->first();
                    if(!$getC){
                        $subSubCategory = new Category();
                        $subSubCategory->parent_id = $getMainCategory->id;
                        $subSubCategory->sub_parent_id = $getSubCategory->id;
                        $subSubCategory->name = json_decode($row['all_categories'])[$key];
                        $subSubCategory->slug = Str::slug(json_decode($row['all_categories'])[$key]) . '-' . Str::random(6);
                        $subSubCategory->commision_rate = 0;
                        $subSubCategory->banner = 'default_category.png';
                        $subSubCategory->save();
                    }
                }
            }
        }


        $brand_id = null;
        $getBrand = Brand::where('name', $row['brand'])->first();
        if($getBrand != ''){
            $brand_id = $getBrand->id;
        }
        else{
            $brand = new Brand();
            $brand->name = $row['brand'];
            $brand->slug = Str::slug($row['brand']).'-'.Str::lower(Str::random(5));
            $brand->save();

            $brand_id = $brand->id;
        }


        //Seller
        $seller_name = json_decode($row['color_sellers'])[0];
        $getSeller = Seller::where('name', $seller_name)->first();
        if($getSeller != ''){
            $seller_id = $getSeller->id;
        }
        else{
            $seller = new Seller();
            $seller->name = $seller_name;
            $seller->email = 'seller_'.Str::lower(Str::random(5)).rand(1000,9999).'@bennebosmarket.com';
            $seller->password = Hash::make('bmarket1234');
            $seller->save();

            $shop = new Shop();
            $shop->seller_id = $seller->id;
            $shop->verification_status = 1;
            $shop->name = $seller_name;
            $shop->slug = Str::slug($seller_name).Str::random(5);
            $shop->logo = json_decode($row['color_sellers_logos'])[0];
            $shop->address = 'Turkey';
            $shop->category_id = $MainCategoryID;
            $shop->save();

            $wallet = new SellerWallet();
            $wallet->seller_id = $seller->id;
            $wallet->save();

            $seller_id = $seller->id;
        }

        $product = new Product();
        $product->added_by = 'seller';
        $product->user_id = $seller_id;
        $product->name = $product_name;
        $product->category_id = $category_id;
        $product->brand_id = $brand_id;
        $product->slug = Str::slug(Str::limit($product_name, 240)) . '-' . Str::random(6);
        $product->unit = $row['unit'];
        $product->min_qty = $row['min_purchase_qty'];
        $product->barcode = $row['barcode'];
        $product->refundable = $row['refundable'];
        $product->thumbnail = $product_thumbnail;
        $product->gallery_image = json_encode($product_gallery);
        $product->video = $row['video_url'];
        $product->color = $row['colors'];
        $product->color_image = $row['color_images'];
        $product->color_titles = $row['color_titles'];
        $product->color_prices = $row['color_prices'];
        $product->size = $product_size;
        $product->unit_price = $product_price;
        $product->discount_date_from = Carbon::parse($row['discount_date_from']);
        $product->discount_date_to = Carbon::parse($row['discount_date_to']);
        $product->discount = $row['discount_percentage'];
        $product->quantity = $row['stock'];
        $product->sku = Str::random(6).rand(1000,9999);
        $product->total_review = 0;
        $product->avg_review = 0;
        $product->description = $product_description;
        $product->meta_title = $row['meta_title'];
        $product->meta_description = $row['meta_description'];
        $product->featured = 0;
        $product->status = 1;
        // $product->save();
        
        foreach(json_decode($row['color_gallery_images']) as $image){
            ProductImage::create([
                'product_id' => $product->id,
                'image' => json_encode($image),
                'status' => 1,
            ]);
        }

        if(json_decode($row['sizes']) != null){
            foreach(json_decode($row['sizes']) as $size){
                ProductSize::create([
                    'product_id' => $product->id,
                    'size' => json_encode($size),
                    'status' => 1,
                ]);

                foreach($size as $ssize){
                    $getSize = Size::where('size', $ssize)->first();
                    if(!$getSize){
                        $sizee = new Size();
                        $sizee->size = $ssize;
                        $sizee->save();
                    }
                }
            }
        }

        if(json_decode($row['color_descriptions']) != null){
            foreach(json_decode($row['color_descriptions']) as $cdescription){
                $cdesc = new ProductColorDescription();
                $cdesc->product_id = $product->id;
                $cdesc->description = $cdescription;
                $cdesc->save();
            }
        }
        
        // if(json_decode(str_replace("'", '"',$row['size_price'])) != null){
        //     foreach(json_decode(str_replace("'", '"',$row['size_price'])) as $sprice){
        //         $spriz = new ProductSizePrice();
        //         $spriz->product_id = $product_id;
        //         $spriz->price = json_encode($sprice);
        //         $spriz->save();
        //     }
        // }
        
        // if(json_decode(str_replace("'", '"',$row['size_titles'])) != null){
        //     foreach(json_decode(str_replace("'", '"',$row['size_titles'])) as $stitle){
        //         $spriz = new ProductSizeTitle();
        //         $spriz->product_id = $product_id;
        //         $spriz->title = json_encode($stitle);
        //         $spriz->save();
        //     }
        // }
        // if(json_decode(str_replace("'", '"',$row['size_descriptions'])) != null){
        //     foreach(json_decode(str_replace("'", '"',$row['size_descriptions'])) as $sdescription){
        //         $spriz = new ProductSizeDescription();
        //         $spriz->product_id = $product_id;
        //         $spriz->description = json_encode($sdescription);
        //         $spriz->save();
        //     }
        // }

    }
}
