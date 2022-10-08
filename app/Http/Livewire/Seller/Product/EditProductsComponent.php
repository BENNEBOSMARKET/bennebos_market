<?php

namespace App\Http\Livewire\Seller\Product;

use Carbon\Carbon;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditProductsComponent extends Component
{
    use WithFileUploads;

    public $tabStatus = 0;
    public $galleryType;

    public $product_id, $name, $slug, $category, $brand, $unit, $minimum_qty, $barcode, $refundable, $gallery_images = [], $thumbnail_image, $uploadedThumbnailImage, $video_link, $unit_price, $discount_date_from, $discount_date_to, $discount, $quantity, $sku, $description, $meta_title, $meta_description, $featured, $status, $color, $selectedcolors, $size, $selectedsizes, $user_id, $uploadedGalleryImages;

    public $color_names = [], $color_images = [], $color_galleries = [], $color_titles = [], $color_sizes = [], $color_prices = [];
    public $get_color_names = [], $get_color_images = [], $get_color_galleries = [], $get_color_prices = [], $get_color_titles = [], $get_color_sizes = [];
    public $edited_color_names = [], $edited_color_images = [], $edited_color_galleries = [], $edited_color_prices = [], $edited_color_titles = [], $edited_color_sizes = [], $edited_gallery_images = [];
    public $remove_color_names = [], $remove_color_images = [];
    public $remove_color_titles = [], $remove_color_prices = [];
    public $color_name, $color_image, $color_gallery = [], $color_title, $color_price, $color_size = [];

    public $pro;

    public $store_status;
    public $product_slug;

    public function mount($id)
    {
        $product = Product::find($id);
        $this->product_slug = $product->slug;

        $this->getProductDetails();
    }

    public function selectGalleryType($val)
    {
        if($val == 1){
            if(count($this->get_color_names) > 0){
                $this->dispatchBrowserEvent('error', ['message'=>'Remove all color varients first!']);
            }
            else{
                $this->galleryType = $val;
            }
        }
        else{
            $this->galleryType = $val;
        }
    }


    public function getProductDetails()
    {
        $product = Product::where('slug', $this->product_slug)->first();

        $this->pro = $product->color;

        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->category = $product->category_id;
        $this->brand = $product->brand_id;
        $this->unit = $product->unit;
        $this->minimum_qty = $product->min_qty;
        $this->barcode = $product->barcode;
        $this->refundable = $product->refundable;
        $this->unit_price = $product->unit_price;
        $this->discount_date_from = $product->discount_date_from;
        $this->discount_date_to = $product->discount_date_to;
        $this->discount = $product->discount;
        $this->quantity = $product->quantity;
        $this->sku = $product->sku;
        $this->description = $product->description;
        $this->uploadedThumbnailImage = $product->thumbnail;
        $this->uploadedGalleryImages = json_decode($product->gallery_image);
        $this->video_link = $product->video;
        $this->color = json_decode($product->color);
        $this->get_color_names = json_decode($product->color);
        $this->edited_color_names = json_decode($product->color);
        $this->edited_color_titles = json_decode($product->color_titles);
        $this->edited_color_prices = json_decode($product->color_prices);
        $this->remove_color_names = json_decode($product->color);
        $this->get_color_images = json_decode($product->color_image);
        $this->get_color_titles = json_decode($product->color_titles);
        $this->get_color_prices = json_decode($product->color_prices);
        $this->edited_color_images = json_decode($product->color_image);
        $this->edited_gallery_images = json_decode($product->gallery_image);
        $this->remove_color_images = json_decode($product->color_image);
        $this->remove_color_titles = json_decode($product->color_titles);
        $this->remove_color_prices = json_decode($product->color_prices);
        $this->selectedcolors = $product->color;
        $this->size = json_decode($product->size);
        $this->selectedsizes = $product->size;
        $this->meta_title = $product->meta_title;
        $this->meta_description = $product->meta_description;
        $this->featured = $product->featured;
        $this->store_status = $product->status;

        if(count($this->color) > 0){
            $this->galleryType = 2;
        }
        else{
            $this->galleryType = 1;
        }
    }

    public function generateslug()
    {
        $this->slug = Str::slug($this->name).'-'.Str::random(6);
    }

    
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

    public function removeColorGallery($key)
    {
        unset($this->remove_color_names[$key]);
        unset($this->remove_color_images[$key]);
        unset($this->remove_color_titles[$key]);
        unset($this->remove_color_prices[$key]);


        $product = Product::where('id', $this->product_id)->first();
        $product->color = json_encode(array_values($this->remove_color_names));
        $product->color_image = json_encode(array_values($this->remove_color_images));
        $product->color_titles = json_encode(array_values($this->remove_color_titles));
        $product->color_prices = json_encode(array_values($this->remove_color_prices));
        $product->save();

        $images = ProductImage::where('product_id', $this->product_id)->get();
        $sizes = ProductSize::where('product_id', $this->product_id)->get();

        foreach($images as $newkey => $img){

            if($newkey == $key){
                $image = ProductImage::find($img->id);
                $image->delete();
            }
        }

        foreach($sizes as $newskey => $siz){

            if($newskey == $key){
                $image = ProductSize::find($siz->id);
                $image->delete();
                
            }
        }
        
        $this->dispatchBrowserEvent('success', ['message'=>'Color gallery item deleted successfully!']);

        $this->getProductDetails();
        
    }

    public function removeGalleryImageFromArray($key)
    {
        unset($this->uploadedGalleryImages[$key]);

        // dd($this->uploadedGalleryImages);
        $product = Product::where('id', $this->product_id)->first();
        $product->gallery_image = json_encode(array_values($this->uploadedGalleryImages));
        $product->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Gallery Image Removed']);
        $this->getProductDetails();
    }

    public function removeGalleryImageFromNewArray($key)
    {
        unset($this->gallery_images[$key]);
        $this->dispatchBrowserEvent('success', ['message'=>'Gallery Image Removed']);
    }

    public function selectStoreMethod($method)
    {
        $this->store_status = $method;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name'=>'required',
            'slug'=>'required|unique:products,slug,'.$this->product_id.'',
            'category'=>'required',
            'minimum_qty'=>'required',
            'unit_price'=>'required',
            'description'=>'required',
            'sku'=>'required',
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


    public function changeApps($value)
    {
        if($value == 1){
            $this->validate([
                'name'=>'required',
                'slug'=>'required|unique:products,slug,'.$this->product_id.'',
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
                    'thumbnail_image'=>'required_if:uploadedThumbnailImage,null'
                ],[
                    'thumbnail_image.required_if'=>'This field is required',
                ]);
                if($this->galleryType == '1'){
                    $this->tabStatus = $value;
                }
                else{
                    if(count($this->color_names) > 0 || count($this->get_color_names) > 0){
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


 
    public function updateProduct()
    {

        $product = Product::where('id', $this->product_id)->first();
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
        $product->thumbnail = $this->uploadedThumbnailImage;

        if($this->thumbnail_image != ''){
            $image_array_1 = explode(";", $this->thumbnail_image);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);

            $imageName = rand(100000, 999999).time() . '.png';
            Storage::disk('s3')->put('imgs/product/'.$imageName, $data);
            $product->thumbnail = env('AWS_BUCKET_URL') . 'imgs/product/'.$imageName;
        }

        if($this->galleryType == '1'){
            if(count($this->gallery_images) > 0){
                
                foreach ($this->gallery_images as $key => $galImg) {
                    $imageName = Carbon::now()->timestamp . Str::random(10) . '.' . $this->gallery_images[$key]->extension();
                    $this->gallery_images[$key]->storeAs('imgs/product', $imageName, 's3');
                    $this->edited_gallery_images[] = env('AWS_BUCKET_URL') . 'imgs/product/'.$imageName;
                }
                $product->gallery_image = json_encode($this->edited_gallery_images);
            }

            // dd($this->edited_gallery_images);
            
            $product->size = json_encode($this->size);
            $product->color = '[]';
        }

        if($this->galleryType == '2'){ 
            
            foreach ($this->color_names as $key => $colors) {
                $imageName = Carbon::now()->timestamp . Str::random(10) . '.' . $this->color_images[$key]->extension();
                $this->color_images[$key]->storeAs('imgs/product', $imageName, 's3');
                $this->edited_color_images[] = $imageName;
                $this->edited_color_names[] = $colors;
                $this->edited_color_titles[] = $this->color_titles[$key];
                $this->edited_color_prices[] = $this->color_prices[$key];
            }
            $product->color_image = json_encode($this->edited_color_images);
            $product->color = json_encode($this->edited_color_names);
            $product->color_titles = json_encode($this->edited_color_titles);
            $product->color_prices = json_encode($this->edited_color_prices);

            // dd($this->edited_color_titles);

            $getSize = ProductSize::where('product_id', $this->product_id)->first();
            if($getSize != ''){
                $product->size = $getSize->size;
            }
            else{
                $product->size = json_encode($this->color_sizes[0]);
            }   
            
        }

        $product->video = $this->video_link;
        $product->meta_title = $this->meta_title;
        $product->meta_description = $this->meta_description;
        $product->featured = $this->featured;
        $product->admin_approval = 0;
        $product->status = 0;

        $product->save();

        if($this->galleryType == '2'){
            if(count($this->color_names) > 0){
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

                foreach($this->color_sizes as $key=>$colos_size){
                    $size = new ProductSize();
                    $size->size = json_encode($this->color_sizes[$key]);
                    $size->product_id = $product->id;
                    $size->save();
                }
            }
        }

        return redirect()->route('seller.allProducts')->with('success', 'Product updated successfully');

    }

    public function deleteImage($id)
    {
        $image = ProductImage::where('id', $id)->first();
        $image->delete();
    }

    public function render()
    {
        // $this->getProductDetails();
        $categories = Category::all();
        $brands = Brand::where('status', 1)->get();
        $sizes = Size::all();

        return view('livewire.seller.product.edit-products-component', ['categories' => $categories, 'brands' => $brands, 'sizes' => $sizes])->layout('livewire.seller.layouts.base');
        

    }
}
