<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Seller;
use App\Models\SellerWallet;
use App\Models\Shop;
use App\Models\Size;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel,WithHeadingRow
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
        $MainCategoryID = '';

        

        if(!str_contains($row['titels'], '"')){
            if(isset(json_decode(str_replace("'", '"',$row['titels']))[0])){
                $product_name = json_decode(str_replace("'", '"',$row['titels']))[0];
            }
            else{
                $product_name = '';
            }
        }
        else{
            if(isset(json_decode($row['titels'])[0])){
                $product_name = json_decode($row['titels'])[0];
            }
            else{
                $product_name = '';
            }
        }


        if(!str_contains($row['size'], '"')){
            if(isset(json_decode(str_replace("'", '"',$row['size']))[0])){
                $product_size = json_encode(json_decode(str_replace("'", '"',$row['size']))[0]);
            }
            else{
                $product_size = '[]';
            }
        }
        else{
            if(isset(json_decode($row['size'])[0])){
                $product_size = json_encode(json_decode($row['size'])[0]);
            }
            else{
                $product_size = '[]';
            }
        }
        
        $product_price = str_replace(' ', '',json_decode(str_replace("'", '"',$row['prices']))[0]);
        $product_thumbnail = json_decode(str_replace("'", '"',$row['thumbnail']))[0];

        $subProductGallery = ["$product_thumbnail"];

        if(isset(json_decode(str_replace("'", '"',$row['color_gallery_images']))[0])){
            $product_gallery = json_decode(str_replace("'", '"',$row['color_gallery_images']))[0];
        }
        else{
            $product_gallery = json_encode($subProductGallery);
        }

        

        if($product_price == 'None'){
            $product_price = 100;
        }
        else{
            $product_price = $product_price;
        }

        
        $getProduct = Product::orderBy('id', 'DESC')->first();
        if($getProduct != ''){
            $product_id = Product::orderBy('id', 'DESC')->first()->id + 1; 
        }
        else{
            $product_id = 1;
        }


        // $mainCategory = json_decode(str_replace("'", '"',$row['all_category']))[1];

        // if(!isset(json_decode(str_replace("'", '"',$row['all_category']))[2])){
        //     $subCategory = '';
        // }
        // else{
        //     $subCategory = json_decode(str_replace("'", '"',$row['all_category']))[2];
        // }

        // if(!isset(json_decode(str_replace("'", '"',$row['all_category']))[3])){
        //     $sSubCategory = '';
        // }
        // else{
        //     $sSubCategory = json_decode(str_replace("'", '"',$row['all_category']))[3];
        // }

        $mainCategory = json_decode($row['all_category'])[1];

        if(!isset(json_decode($row['all_category'])[2])){
            $subCategory = '';
        }
        else{
            $subCategory = json_decode($row['all_category'])[2];
        }

        if(!isset(json_decode($row['all_category'])[3])){
            $sSubCategory = '';
        }
        else{
            $sSubCategory = json_decode($row['all_category'])[3];
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
            foreach(json_decode($row['all_category']) as $key => $sscat){
                if($key > 3){
                    $getC = Category::where('parent_id', $getMainCategory->id)->where('sub_parent_id', $getSubCategory->id)->where('name', json_decode($row['all_category'])[$key])->first();
                    if(!$getC){
                        $subSubCategory = new Category();
                        $subSubCategory->parent_id = $getMainCategory->id;
                        $subSubCategory->sub_parent_id = $getSubCategory->id;
                        $subSubCategory->name = json_decode($row['all_category'])[$key];
                        $subSubCategory->slug = Str::slug(json_decode($row['all_category'])[$key]) . '-' . Str::random(6);
                        $subSubCategory->commision_rate = 0;
                        $subSubCategory->banner = 'default_category.png';
                        $subSubCategory->save();
                    }
                }
            }
        }

        // if($getMainCategory && $getSubCategory){
        //     foreach(json_decode(str_replace("'", '"',$row['all_category'])) as $key => $sscat){
        //         if($key > 3){
        //             $getC = Category::where('parent_id', $getMainCategory->id)->where('sub_parent_id', $getSubCategory->id)->where('name', json_decode(str_replace("'", '"',$row['all_category']))[$key])->first();
        //             if(!$getC){
        //                 $subSubCategory = new Category();
        //                 $subSubCategory->parent_id = $getMainCategory->id;
        //                 $subSubCategory->sub_parent_id = $getSubCategory->id;
        //                 $subSubCategory->name = json_decode(str_replace("'", '"',$row['all_category']))[$key];
        //                 $subSubCategory->slug = Str::slug(json_decode(str_replace("'", '"',$row['all_category']))[$key]) . '-' . Str::random(6);
        //                 $subSubCategory->commision_rate = 0;
        //                 $subSubCategory->banner = 'default_category.png';
        //                 $subSubCategory->save();
        //             }
        //         }
        //     }
        // }


        $brand_id = null;
        $getBrand = Brand::where('name', $row['marka'])->first();
        if($getBrand != ''){
            $brand_id = $getBrand->id;
        }
        else{
            $brand = new Brand();
            $brand->name = $row['marka'];
            $brand->slug = Str::slug($row['marka']).'-'.Str::lower(Str::random(5));
            $brand->save();

            $brand_id = $brand->id;
        }

        

        $getSeller = Seller::where('name', $row['seller_name'])->first();
        if($getSeller != ''){
            $seller_id = $getSeller->id;
        }
        else{
            $seller = new Seller();
            $seller->name = $row['seller_name'];
            $seller->email = 'seller_'.Str::lower(Str::random(5)).rand(1000,9999).'@bennebosmarket.com';
            $seller->password = Hash::make('bmarket1234');
            $seller->save();

            $shop = new Shop();
            $shop->seller_id = $seller->id;
            $shop->verification_status = 1;
            $shop->name = $row['seller_name'];
            $shop->slug = Str::slug($row['seller_name']).Str::random(5);
            $shop->logo = $row['seller_logo'];
            $shop->address = 'Turkey';
            $shop->category_id = $MainCategoryID;
            $shop->save();

            $wallet = new SellerWallet();
            $wallet->seller_id = $seller->id;
            $wallet->save();

            $seller_id = $seller->id;
        }

        foreach(json_decode(str_replace("'", '"',$row['color_gallery_images'])) as $image){
            ProductImage::create([
                'product_id' => $product_id,
                'image' => json_encode($image),
                'status' => 1,
            ]);
        }
        
        if(!str_contains($row['size'], '"')){
            if(json_decode(str_replace("'", '"',$row['size'])) != null){
                foreach(json_decode(str_replace("'", '"',$row['size'])) as $size){
                    ProductSize::create([
                        'product_id' => $product_id,
                        'size' => json_encode($size),
                        'status' => 1,
                    ]);
    
                    foreach(str_replace("'", '"',$size) as $ssize){
                        $getSize = Size::where('size', $ssize)->first();
                        if(!$getSize){
                            $sizee = new Size();
                            $sizee->size = $ssize;
                            $sizee->save();
                        }
                    }
                }
            }
        }
        else{
            if(json_decode($row['size']) != null){
                try{
                    foreach(json_decode($row['size']) as $size){
                        // dd(json_encode($size));
                        ProductSize::create([
                            'product_id' => $product_id,
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
                catch(Exception $e){
                    dd($e->getMessage());
                }
                
            }
        }

        // if(json_decode(str_replace("'", '"',$row['color_descriptions'])) != null){
        //     foreach(json_decode(str_replace("'", '"',$row['color_descriptions'])) as $cdescription){
        //         $cdesc = new ProductColorDescription();
        //         $cdesc->product_id = $product_id;
        //         $cdesc->description = $cdescription;
        //         $cdesc->save();
        //     }
        // }


        
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

        return new Product([
            'id' => $product_id,
            'added_by' => 'admin',
            'user_id' => $seller_id,
            'name' => $product_name,
            'category_id' => $category_id,
            'brand_id' => $brand_id,
            'slug' => Str::slug(Str::limit($product_name, 240)) . '-' . Str::random(6),
            'unit' => $row['unit'],
            'min_qty' => $row['min_purchase_qty'],
            'barcode' => $row['barcode'],
            'refundable' => $row['refundable'],
            'thumbnail' => $product_thumbnail,
            'gallery_image' => json_encode($product_gallery),
            'video' => $row['video_url'],
            'color' => str_replace("'", '"',$row['color']),
            'color_image' => str_replace("'", '"',$row['image_color']),
            'color_titles' => str_replace("'", '"',$row['titels']),
            'color_prices' => str_replace("'", '"',$row['prices']),
            'size' => $product_size,
            'unit_price' => $product_price,
            'discount_date_from' => Carbon::parse($row['discount_date_from']),
            'discount_date_to' => Carbon::parse($row['discount_date_to']),
            'discount' => $row['discount_percentage'],
            'quantity' => $row['stock'],
            'sku' => Str::random(6).rand(1000,9999),
            'total_review' => 0,
            'avg_review' => 0,
            'description' => $row['description'],
            'meta_title' => $row['meta_title'],
            'meta_description' => $row['meta_description'],
            'featured' => 0,
            'status' => 1,
        ]);

    }
}