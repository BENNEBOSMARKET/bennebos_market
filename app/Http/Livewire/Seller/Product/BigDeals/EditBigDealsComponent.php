<?php

namespace App\Http\Livewire\Seller\Product\BigDeals;

use App\Http\Livewire\Admin\Cms\ShowProductComponent;
use App\Models\BigDealsPhoto;
use App\Models\BigDealsProduct;
use App\Models\Country;
use App\Models\ProductsColor;
use App\Models\Seller;
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

class EditBigDealsComponent extends Component
{
    use WithFileUploads;

    public $tabStatus = 0;

    public $slug,$name,$product_img,$bigDealsPhoto_id,$big_deals_photo, $category, $country_id,$subCategory_id, $refundable = 1,$quantity, $sku, $description,$sub_sub_category_id,$price,$new_product_img,$new_description_photo;
    public $model_no,$certification,$feet,$condition,$description_photo,$note,$seller,$image,$new_image;

    public $big_deals_id;

    public function mount($slug)
    {
        $this->big_deals_id= $slug;

        $this->getProductDetails();
    }



    public function getProductDetails()
    {
        $big_deals_photo=BigDealsPhoto::where('bigDealsPhoto_id', $this->big_deals_id)->first();
        if ($big_deals_photo != null){

            $this->bigDealsPhoto_id=$big_deals_photo->bigDealsPhoto_id;
            $this->new_image=$big_deals_photo->image;
        }

        $big_deals = BigDealsProduct::where('id', $this->big_deals_id)->first();

        $this->name = $big_deals->name;
        $this->sub_sub_category_id = $big_deals->sub_sub_category_id;
        $this->subCategory_id = $big_deals->subCategory_id;
        $this->category = $big_deals->category_id;
        $this->country_id = $big_deals->country_id;
        $this->price=$big_deals->price;
        $this->quantity = $big_deals->quantity;
        $this->refundable = $big_deals->refundable;
        $this->model_no = $big_deals->model_no;
        $this->certification = $big_deals->certification;
        $this->feet = $big_deals->feet;
        $this->condition = $big_deals->condition;
        $this->sku = $big_deals->sku;
        $this->description = $big_deals->description;
        $this->new_description_photo = $big_deals->description_photo;
        $this->new_product_img=$big_deals->product_img;
    }

    public function changeApps($value)
    {
        if($value == 1){
            $this->validate([
                'name'=>'required',
                'category'=>'required',
                'subCategory_id'=>'required',
                'sub_sub_category_id'=>'required',
                'price'=>'required',
                'quantity'=>'required',
            ]);
            $this->tabStatus = $value;
        }
        else if($value == 2){
            $this->validate([
                'model_no'=>'required',
                'certification'=>'required',
                'feet'=>'required',
                'condition'=>'required',
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

            $this->tabStatus = $value;
        }

    }
    public function goBack($value)
    {
        $this->tabStatus = $value;
    }






    public function updateProduct()
    {

        $bid_deals_photo = BigDealsPhoto::where('bigDealsPhoto_id', $this->slug)->first();
        if ($bid_deals_photo != null){

            $bid_deals_photo->image = $this->new_image;


            if ($this->image !=''){
                $imageName = Carbon::now()->timestamp. '.' . $this->image->extension();

                $this->image->storeAs('imgs/bigDeals/',$imageName, 's3');
                $bid_deals_photo->image = env('AWS_BUCKET_URL') . 'imgs/bigDeals/'.$imageName;
            }
            $bid_deals_photo->bigDealsPhoto_id = $this->bigDealsPhoto_id;
            $bid_deals_photo->save();
        }


        $big_deals_product = BigDealsProduct::where('id', $this->slug)->first();
//        dd($this->all());
        $big_deals_product->product_img = $this->new_product_img;
        $big_deals_product->description_photo = $this->new_description_photo;

        if ($this->product_img !=''){
            $imageName = Carbon::now()->timestamp. '.' . $this->product_img->extension();

            $this->product_img->storeAs('imgs/bigDeals/',$imageName, 's3');
            $big_deals_product->product_img = env('AWS_BUCKET_URL') . 'imgs/bigDeals/'.$imageName;
        }

        if ($this->description_photo !=''){
            $imageName = Carbon::now()->timestamp. '.' . $this->description_photo->extension();

            $this->description_photo->storeAs('imgs/bigDeals/',$imageName, 's3');
            $big_deals_product->description_photo = env('AWS_BUCKET_URL') . 'imgs/bigDeals/'.$imageName;
        }


        $big_deals_product->name = $this->name;
        $big_deals_product->category_id = $this->category;
        $big_deals_product->subCategory_id = $this->subCategory_id;
        $big_deals_product->sub_sub_category_id = $this->sub_sub_category_id;
        $big_deals_product->refundable = $this->refundable;
        $big_deals_product->price = $this->price;
        $big_deals_product->quantity = $this->quantity;
        $big_deals_product->sku = $this->sku;
        $big_deals_product->description = $this->description;
        $big_deals_product->seller_id = authSeller()->id;
        $big_deals_product->country_id = $this->country_id;
        $big_deals_product->certification = $this->certification;
        $big_deals_product->feet = $this->feet;
        $big_deals_product->model_no = $this->model_no;
        $big_deals_product->condition = $this->condition;
        $big_deals_product->note = $this->note;

        $big_deals_product->save();
        return redirect()->route('seller.BigDealsProduct')->with('success', 'Product updated successfully');
    }


    public function render()
    {

        $categories = Category::where("country_id", shop(authSeller()->id)->country_id)->get();

        $subCategories = Category::where("parent_id", $this->category)->where('sub_parent_id', 0)->get();
        $subSubCategories = Category::where("parent_id", $this->category)->where('sub_parent_id', $this->subCategory_id)->get();
        $sizesProducts = Size::where("sub_sub_category_id", $this->sub_sub_category_id)->get();
        $ColorsProducts = ProductsColor::where("sub_sub_category_id", $this->sub_sub_category_id)->get();
        $sellers = Seller::get(['id', 'name']);
        $big_deals_photo=BigDealsPhoto::where('bigDealsPhoto_id', $this->big_deals_id)->get();

        return view('livewire.seller.product.bigDeals.edit-big-deals-component', [
            'categories' => $categories,
            'sellersOptions' => $sellers,
            'sizesProducts' => $sizesProducts,
            'subCategories' => $subCategories,
            'subSubCategories' => $subSubCategories,
            'ColorsProducts' => $ColorsProducts,
            'big_deals_photo'=>$big_deals_photo,

        ])->layout('livewire.seller.layouts.base');
    }
}
