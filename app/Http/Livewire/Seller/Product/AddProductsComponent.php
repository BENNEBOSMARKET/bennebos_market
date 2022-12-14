<?php

namespace App\Http\Livewire\Seller\Product;

use App\Models\ProductsColor;
use Carbon\Carbon;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Category;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use App\Models\Seller;
use App\Traits\FileHandler;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AddProductsComponent extends Component
{
    use WithFileUploads, FileHandler;

    public $tabStatus = 0;
    public $galleryType;

    public $name, $slug, $category,$subCategory_id, $brand, $unit, $minimum_qty, $guarantee, $barcode, $refundable = 1, $gallery_images = [], $thumbnail_image, $video_link, $unit_price, $discount_date_from, $discount_date_to, $discount = 0, $quantity, $sku, $description, $meta_title, $meta_description, $featured = 0, $status, $color = [], $size = [], $user_id;
    public $store_status,$shipping;


    public $product_names=[],$sub_sub_categories_id=[],$color_names = [], $color_images = [], $color_galleries = [], $color_titles = [], $color_sizes = [], $color_prices = [],$types_id=[],$product_sizes=[];
    public $color_name, $color_image, $color_title, $color_price, $color_size, $color_gallery = [],$product_size=[],$sub_sub_category_id=[];
    public $color_description, $color_descriptions = [] , $seller, $sellers = [];

    public function selectGalleryType($val)
    {
        $this->galleryType = $val;
    }


    public function generateslug()
    {
        $this->slug = Str::slug($this->name).'-'.Str::random(6);
    }


    public function selectStoreMethod($method)
    {
        $this->store_status = $method;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name'=>'required',
            'slug'=>'required|unique:products,slug',
            'category'=>'required',
            'minimum_qty'=>'required',
            'unit_price'=>'required',
            'description'=>'required',
            'thumbnail_image'=>'required',
            'sku'=>'required',
            'color_name'=>'required',
            'color_image'=>'required',
            'color_gallery'=>'required',
            'guarantee'=>'required',

        ]);
    }

    public function refundableStatus()
    {
        if($this->refundable == 0){
            $this->refundable = 1;
        }
        else{
            $this->refundable = 0;
        }
    }

    public function featuredStatus()
    {
        if($this->featured == 0){
            $this->featured = 1;
        }
        else{
            $this->featured = 0;
        }
    }


    public function addColor()
    {
        $this->validate([
            'color_name'=>'required',
            'color_image'=>'required',
            'color_gallery'=>'required',
            'color_title'=>'required',
            'color_price'=>'required',
            'sub_sub_category_id'=>'required',
            'product_size'=>'required',
            'color_description'=>'required',
        ]);

//        dd($this->all());
        array_push($this->color_names, $this->color_name);
        array_push($this->color_images, $this->color_image);
        array_push($this->color_galleries, $this->color_gallery);
        array_push($this->color_titles, $this->color_title);
        array_push($this->color_prices, $this->color_price);
        array_push($this->sellers, authSeller()->id);
        array_push($this->color_descriptions, $this->color_description);
        array_push($this->sub_sub_categories_id,$this->sub_sub_category_id);
        array_push($this->product_sizes, $this->product_size);

        // dd(json_encode($this->color_titles));

        $this->color_name = '';
        $this->color_image = '';
        $this->color_gallery = '';
        $this->color_title = '';
        $this->color_price = '';
        $this->color_description = '';
        $this->sub_sub_category_id = '';
        $this->product_size = '';


        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'New Item Added!']);
    }

    public function addProductSize()
    {
        $this->validate([

            'type_id'=>'required',
            'product_size'=>'required',

        ]);

//        dd($this->all());
        array_push($this->types_id,$this->type_id);
        array_push($this->product_sizes, $this->product_size);
        array_push($this->sellers, authSeller()->id);

        $this->type_id = '';
        $this->product_size = '';


        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'New Item Added!']);
    }

    public function removeFromArray($key)
    {
        unset($this->color_names[$key]);
        unset($this->color_images[$key]);
        unset($this->color_galleries[$key]);
        unset($this->color_titles[$key]);
        unset($this->color_prices[$key]);
        unset($this->sellers[$key]);
        unset($this->color_descriptions[$key]);

        $this->dispatchBrowserEvent('error', ['message'=>'Item Removed!']);
    }

    public function changeApps($value)
    {
        if($value == 1){
            $this->validate([
                'name'=>'required',
                'slug'=>'required|unique:products,slug',
                'category'=>'required',
                'minimum_qty'=>'required',
            ]);
            $this->tabStatus = $value;
        }
        else if($value == 2){
            $this->validate([
                'unit_price'=>'required',
                'sku'=>'required',
            ]);
            $this->tabStatus = $value;
        }
        else if($value == 3){
            $this->validate([
                'description'=>'required',
            ]);
            $this->tabStatus = $value;
        }

        else if($value == 4){
            if($this->galleryType != ''){
                $this->validate([
                    'thumbnail_image'=>'required',
                ]);
                if($this->galleryType == '1'){
                    $this->tabStatus = $value;
                }
                else{
                    if(count($this->color_names) > 0){
                        $this->tabStatus = $value;
                    }
                    else{
                        $this->dispatchBrowserEvent('error', ['message'=>'Add color variations']);
                    }
                }
            }
            else{
                $this->dispatchBrowserEvent('error', ['message'=>'Select gallery type!']);
            }
        }
    }

    public function goBack($value)
    {
        $this->tabStatus = $value;
    }
    public function extractImage($image)
    {
        $image_array_1 = explode(";", $image);
        $image_array_2 = explode(",", $image_array_1[1]);
        return base64_decode($image_array_2[1]);
    }


    public function storeProduct()
    {
        $main_product_id = null;
        if($this->galleryType == '2'){
            foreach ($this->color_names as $index => $name) {


                $thumbnail = $this->saveProductDetailsThumbnail($this->extractImage($this->thumbnail_image));
                $images = $this->saveProductDetailsImages($this->color_galleries[$index]);
                $color = Color::create([
                    'product_color_id'  => Str::lower($this->color_names[$index]),
                    'name'  => Str::lower($this->color_names[$index]),
                    "sub_sub_category_id"=>$this->sub_sub_categories_id[$index],
                    'image' => $this->saveProductDetailsImages($this->color_images[$index])
                ]);
                if ( $index == 0) {
                    $newProduct = Product::create([
                        "name" => Str::lower($this->color_titles[$index]),
                        "slug" => Str::slug(Str::lower($this->color_titles[$index])) . "-" . uniqid(),
                        "title" => Str::lower($this->color_titles[$index]),
                        "added_by" => 'admin',
                        "description" => trim($this->color_descriptions[$index]),
                        "category_id" => $this->category,
                        "subCategory_id" => $this->subCategory_id,
                        "size_id" => $this->product_sizes[$index],
                        "sub_sub_category_id"=>$this->sub_sub_categories_id[$index],
                        "color_id" => $color->id,
                        "product_color_id"=>$this->color_names[$index],
                        "user_id" => $this->sellers[$index],
                        "gallery_image" => is_array($images) ? json_encode($images): $images,
                        "thumbnail" => $thumbnail,
                        "guarantee" => $this->guarantee,
                        "status" => 1,
                        "min_qty" => $this->minimum_qty,
                        "quantity" => $this->quantity,
                        "unit" => $this->unit,
                        "refundable" => $this->refundable,
                        "discount_date_from" => $this->discount_date_from,
                        "discount_date_to" => $this->discount_date_to,
                        "discount" => $this->discount,
                        "sku" => $this->sku,
                        "shipping" => $this->shipping,
                        "video" => $this->video_link,
                        "meta_title" => trim($this->meta_title),
                        "meta_description" => trim($this->meta_description),
                        "unit_price" => (float)$this->color_prices[$index],
                        "featured" => $this->featured,
                        "color_image" => json_encode([]),
                        "color_titles" => json_encode([]),
                        "color_prices" => json_encode([]),
                        "size" => json_encode([]),
                        "color" => json_encode([]),
                    ]);

                    $main_product_id = $newProduct->id;
                    $newProduct->update(['main_product_id' => $newProduct->id]);
                    $newProduct->refresh();

                } else {

                    Product::create([
                        "name" => Str::lower($this->color_titles[$index]),
                        "slug" => Str::slug(Str::lower($this->color_titles[$index])) . "-" . uniqid(),
                        "title" => Str::lower($this->color_titles[$index]),
                        "added_by" => 'admin',
                        'main_product_id' => $main_product_id,
                        "description" => trim($this->color_descriptions[$index]),
                        "category_id" => $this->category,
                        "subCategory_id" => $this->subCategory_id,
                        "size_id" => $this->product_sizes[$index],
                        "sub_sub_category_id"=>$this->sub_sub_categories_id[$index],
                        "brand_id" => $this->brand,
                        "color_id" => $color->id,
                        "product_color_id"=>$this->color_names[$index],
                        "user_id" => $this->sellers[$index],
                        "gallery_image" => is_array($images) ? json_encode($images): $images,
                        "thumbnail" => $thumbnail,
                        "guarantee" => $this->guarantee,
                        "status" => 1,
                        "min_qty" => $this->minimum_qty,
                        "quantity" => $this->quantity,
                        "unit" => $this->unit,
                        "refundable" => $this->refundable,
                        "discount_date_from" => $this->discount_date_from,
                        "discount_date_to" => $this->discount_date_to,
                        "discount" => $this->discount,
                        "sku" => $this->sku,
                        "shipping" => $this->shipping,
                        "video" => $this->video_link,
                        "meta_title" => trim($this->meta_title),
                        "meta_description" => trim($this->meta_description),
                        "unit_price" => (float)$this->color_prices[$index],
                        "featured" => $this->featured ? 1 : 0,
                        "color_image" => json_encode([]),
                        "color_titles" => json_encode([]),
                        "color_prices" => json_encode([]),
                        "size" => json_encode([]),
                        "color" => json_encode([]),
                    ]);
                }
            }

        }

        // $product->video = $this->video_link;

        // $product->meta_title = $this->meta_title;
        // $product->meta_description = $this->meta_description;
        // $product->featured = $this->featured;
        // $product->status = 0;

        // $product->save();

        if($this->galleryType == '1'){
            // dd(1);
            foreach ($this->types_id as $index => $name) {



//            dd($this->all());

                $thumbnail = $this->saveProductDetailsThumbnail($this->extractImage($this->thumbnail_image));
                $images = $this->saveProductDetailsImages($this->gallery_images);
//            dd($this->all());
                if ( $index == 0) {

                    $newProduct = Product::create([
                        "name" => trim($this->name),
                        "slug" => $this->slug . "-" . uniqid(),
                        "title" => trim($this->name),
                        "added_by" => 'admin',
                        "description" => trim($this->description),
                        "category_id" => $this->category,
                        "size_id" =>  $this->product_sizes[$index],
                        "type_id" =>  $this->types_id[$index],//needs modification
                        "user_id" => $this->sellers[$index],
                        "brand_id" => $this->brand,
                        "color_id" => null,
                        "gallery_image" => $images,
                        "thumbnail" => $thumbnail,
                        "status" => 1,
                        "min_qty" => $this->minimum_qty,
                        "guarantee" => $this->guarantee,
                        "quantity" => $this->quantity,
                        "unit" => $this->unit,
                        "refundable" => $this->refundable,
                        "discount_date_from" => $this->discount_date_from,
                        "discount_date_to" => $this->discount_date_to,
                        "discount" => $this->discount,
                        "sku" => $this->sku,
                        "shipping" => $this->shipping,
                        "video" => $this->video_link,
                        "meta_title" => trim($this->meta_title),
                        "meta_description" => trim($this->meta_description),
                        "unit_price" => (float)$this->unit_price,
                        "featured" => $this->featured,
                        "color_image" => json_encode([]),
                        "color_titles" => json_encode([]),
                        "color_prices" => json_encode([]),
                        "size" => json_encode([]),
                        "color" => json_encode([]),
                    ]);
                    $main_product_id = $newProduct->id;
                    $newProduct->update(['main_product_id' => $newProduct->id]);
                    $newProduct->refresh();
                }
                else{
//dd( $this->types_id[$index]);
                    Product::create([
                        "name" => trim($this->name),
                        "slug" => $this->slug . "-" . uniqid(),
                        "title" => trim($this->name),
                        "added_by" => 'admin',
                        'main_product_id' => $main_product_id,
                        "description" => trim($this->description),
                        "category_id" => $this->category,
                        "size_id" =>  $this->product_sizes[$index], //needs modification
                        "type_id" =>  $this->types_id[$index],
                        "brand_id" => $this->brand,
                        "color_id" => null,
                        "user_id" => $this->sellers[$index],
                        "gallery_image" => $images,
                        "thumbnail" => $thumbnail,
                        "status" => 1,
                        "min_qty" => $this->minimum_qty,
                        "quantity" => $this->quantity,
                        "unit" => $this->unit,
                        "refundable" => $this->refundable,
                        "discount_date_from" => $this->discount_date_from,
                        "discount_date_to" => $this->discount_date_to,
                        "discount" => $this->discount,
                        "sku" => $this->sku,
                        "shipping" => $this->shipping,
                        "video" => $this->video_link,
                        "meta_title" => trim($this->meta_title),
                        "meta_description" => trim($this->meta_description),
                        "unit_price" => (float)$this->unit_price,
                        "featured" => $this->featured,
                        "color_image" => json_encode([]),
                        "color_titles" => json_encode([]),
                        "color_prices" => json_encode([]),
                        "size" => json_encode([]),
                        "color" => json_encode([]),
                    ]);
                }



                $newProduct->update(['main_product_id' => $newProduct->id]);
                $newProduct->refresh();

            }
        }

        return redirect()->route('seller.allProducts')->with('success', 'New product added successfully');

    }

    public function render()
    {
        $allowed_country = shop(authSeller()->id)->country_id;
        $categories = Category::where("country_id",$allowed_country)->get();
        $subCategories = Category::where("parent_id", $this->category)->where('sub_parent_id',0)->get();
        $subSubCategories = Category::where("parent_id", $this->category)->where('sub_parent_id',$this->subCategory_id)->get();
        $brands = Brand::where('status', 1)->where("country_id",$allowed_country)->get();
        $sizesProducts = Size::where("sub_sub_category_id", $this->sub_sub_category_id)->get();
        $ColorsProducts = ProductsColor::where("sub_sub_category_id", $this->sub_sub_category_id)->get();
        $sellers = Seller::get(['id', 'name']);
        return view('livewire.seller.product.add-products-component', [
            'sizesProducts' => $sizesProducts,
            'subCategories'=>$subCategories,
            'subSubCategories'=>$subSubCategories,
            'ColorsProducts'=>$ColorsProducts,'categories' => $categories, 'brands' => $brands,'sellersOptions' => $sellers])->layout('livewire.seller.layouts.base');

    }
}
