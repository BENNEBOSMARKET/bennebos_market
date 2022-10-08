<?php

namespace App\Http\Livewire\Seller\Product;

use Carbon\Carbon;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AddProductsComponent extends Component
{
    use WithFileUploads;

    public $tabStatus = 0;
    public $galleryType;

    public $name, $slug, $category, $brand, $unit, $minimum_qty, $barcode, $refundable = 1, $gallery_images = [], $thumbnail_image, $video_link, $unit_price, $discount_date_from, $discount_date_to, $discount = 0, $quantity, $sku, $description, $meta_title, $meta_description, $featured = 0, $status, $color = [], $size = [], $user_id;

    public $store_status;


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

    public $color_names = [], $color_images = [], $color_galleries = [], $color_titles = [], $color_sizes = [], $color_prices = [];
    public $color_name, $color_image, $color_title, $color_price, $color_size = [], $color_gallery = [];
    
    public function addColor()
    {
        $this->validate([
            'color_name'=>'required',
            'color_image'=>'required',
            'color_gallery'=>'required',
            'color_title'=>'required',
            'color_price'=>'required',
            'color_size'=>'required',
        ]);

        array_push($this->color_names, $this->color_name);
        array_push($this->color_images, $this->color_image);
        array_push($this->color_galleries, $this->color_gallery);
        array_push($this->color_titles, $this->color_title);
        array_push($this->color_sizes, $this->color_size);
        array_push($this->color_prices, $this->color_price);

        // dd(json_encode($this->color_titles));

        $this->color_name = '';
        $this->color_image = '';
        $this->color_gallery = '';
        $this->color_title = '';
        $this->color_price = '';

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'New Item Added!']);
    }

    public function removeFromArray($key)
    {
        unset($this->color_names[$key]);
        unset($this->color_images[$key]);
        unset($this->color_galleries[$key]);
        unset($this->color_titles[$key]);
        unset($this->color_sizes[$key]);
        unset($this->color_prices[$key]);

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


    public function storeProduct()
    {
        $product = new Product();
        $product->added_by = 'Seller';
        $product->user_id = authSeller()->id;
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->category_id = $this->category;
        $product->brand_id = $this->brand;
        $product->unit = $this->unit;
        $product->min_qty = $this->minimum_qty;
        $product->barcode = $this->barcode;
        $product->refundable = $this->refundable;
        $product->unit_price = $this->unit_price;
        $product->discount_date_from = $this->discount_date_from;
        $product->discount_date_to = $this->discount_date_to;
        $product->discount = $this->discount;
        $product->quantity = $this->quantity;
        $product->sku = $this->sku;
        $product->description = $this->description;

        $image_array_1 = explode(";", $this->thumbnail_image);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);

        $imageName = rand(100000, 999999).time() . '.png';
        Storage::disk('s3')->put('imgs/product/'.$imageName, $data);

        $product->thumbnail = env('AWS_BUCKET_URL') . 'imgs/product/'.$imageName;

        if($this->galleryType == '1'){
            $galImgArray = [];
            foreach ($this->gallery_images as $key => $galImg) {
                $imageName = Carbon::now()->timestamp . Str::random(10) . '.' . $this->gallery_images[$key]->extension();
                $this->gallery_images[$key]->storeAs('imgs/product', $imageName, 's3');
                $galImgArray[] = env('AWS_BUCKET_URL') . 'imgs/product/'.$imageName;
            }

            $product->gallery_image = json_encode($galImgArray);
            $product->size = json_encode($this->size);
            $product->color = '[]';
        }

        if($this->galleryType == '2'){ 
            $product->color = json_encode($this->color_names);

            $cimgArray = [];
            foreach ($this->color_names as $key => $colors) {
                $imageName = Carbon::now()->timestamp . Str::random(10) . '.' . $this->color_images[$key]->extension();
                $this->color_images[$key]->storeAs('imgs/product', $imageName, 's3');
                $cimgArray[] = env('AWS_BUCKET_URL') . 'imgs/product/'.$imageName;
            }
            $product->color_image = json_encode($cimgArray);
            $product->color_titles = json_encode($this->color_titles);
            $product->color_prices = json_encode($this->color_prices);
            
            $product->size = json_encode($this->color_sizes[0]);
        }

        $product->video = $this->video_link;

        $product->meta_title = $this->meta_title;
        $product->meta_description = $this->meta_description;
        $product->featured = $this->featured;
        $product->status = 0;

        $product->save();

        if($this->galleryType == '2'){
            foreach($this->color_sizes as $key=>$colos_size){
                $size = new ProductSize();
                $size->size = json_encode($this->color_sizes[$key]);
                $size->product_id = $product->id;
                $size->save();
            }
    
            foreach ($this->color_names as $key => $colors) {
                $imgArray = [];
    
                foreach($this->color_galleries[$key] as $sl => $item){
                    $imageName = Carbon::now()->timestamp . Str::random(10) . '.' . $this->color_galleries[$key][$sl]->extension();
                    $this->color_galleries[$key][$sl]->storeAs('imgs/product', $imageName, 's3');
    
                    $imgArray[] = env('AWS_BUCKET_URL') . 'imgs/product/'.$imageName;
                }
                $pimage = new ProductImage();
                $pimage->product_id = $product->id;
                $pimage->image = json_encode($imgArray);
                $pimage->save();
            }
        }

        return redirect()->route('seller.allProducts')->with('success', 'New product added successfully');

    }

    public function render()
    {
        $categories = Category::all();
        $brands = Brand::where('status', 1)->get();
        $sizes = Size::all();

        return view('livewire.seller.product.add-products-component', ['categories' => $categories, 'brands' => $brands, 'sizes' => $sizes])->layout('livewire.seller.layouts.base');
        
    }
}
