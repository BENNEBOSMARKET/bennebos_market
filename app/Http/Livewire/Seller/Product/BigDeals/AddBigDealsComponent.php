<?php

namespace App\Http\Livewire\Seller\Product\BigDeals;

use App\Models\BigDealsPhoto;
use App\Models\BigDealsProduct;
use App\Models\Category;
use App\Models\Country;
use App\Models\ProductsColor;
use App\Models\Seller;
use App\Models\Size;
use App\Traits\FileHandler;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddBigDealsComponent extends Component
{
    use WithFileUploads, FileHandler;

    public $tabStatus = 0;
    public $name, $category, $country_id,$subCategory_id, $refundable = 1,$quantity, $sku, $description,$sub_sub_category_id,$price;
    public $model_no,$certification,$feet,$condition,$description_photo,$main_photo,$note;
    public  $seller,$photo=[],$big_deals_photos=[];

    public function addProductPhoto()
    {
        $this->validate([

            'photo'=>'required',
        ]);

//        dd($this->all());
        array_push($this->big_deals_photos,$this->photo);

        $this->photo = '';


        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'New Item Added!']);
    }
    public function removeFromArray($key)
    {
        unset($this->photos[$key]);

        $this->dispatchBrowserEvent('error', ['message'=>'Item Removed!']);
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
                'description_photo'=>'required',
            ]);
            $this->tabStatus = $value;
        }

        else if($value == 4){
            $this->validate([
                'main_photo'=>'required',
            ]);
            $this->tabStatus = $value;
        }
    }

    public function goBack($value)
    {
        $this->tabStatus = $value;
    }

    public function storeProduct()
    {

        $imageDescription = Carbon::now()->timestamp. '.' . $this->description_photo->extension();

        $this->main_photo->storeAs('imgs/bigDeals/',$imageDescription, 's3');
        $description_photo = env('AWS_BUCKET_URL') . 'imgs/bigDeals/'.$imageDescription;

        $imageName = Carbon::now()->timestamp. '.' . $this->main_photo->extension();

        $this->main_photo->storeAs('imgs/bigDeals/',$imageName, 's3');
        $product_img = env('AWS_BUCKET_URL') . 'imgs/bigDeals/'.$imageName;
        $newBigDeals = BigDealsProduct::create([
            "name" => $this->name,
            "product_img"=>$product_img,
            "category_id"=>$this->category,
            "subCategory_id"=>$this->subCategory_id,
            "sub_sub_category_id"=>$this->sub_sub_category_id,
            "country_id"=>$this->country_id,
            "seller_id"=>authSeller()->id,
            "model_no"=>$this->model_no,
            "certification"=>$this->certification,
            "feet"=>$this->feet,
            "condition"=>$this->condition,
            "sku"=>$this->sku,
            "price"=>$this->price,
            "quantity"=>$this->quantity,
            "description"=>$this->description,
            "description_photo"=>$description_photo,
            "refundable"=>$this->refundable,

        ]);
            foreach ($this->big_deals_photos as $index => $name) {

                    if ( $index == 0) {
                        BigDealsPhoto::create([
                        "bigDealsPhoto_id"=>$newBigDeals->id,
                        'image' => $this->saveBigDealsPhotosImages($this->big_deals_photos[$index])
                    ]);
                     }
                        else{
                        BigDealsPhoto::create([
                        "bigDealsPhoto_id"=>$newBigDeals->id,
                        'image' => $this->saveBigDealsPhotosImages($this->big_deals_photos[$index])]);
                    }
                }
        return redirect()->route('admin.BigDealsProduct')->with('success', 'New Big Deals  added successfully');

    }


    public function render()
    {
        $allowed_country = shop(authSeller()->id)->country_id;
        $categories = Category::where("country_id",$allowed_country)->get();;

        $subCategories = Category::where("parent_id", $this->category)->where('sub_parent_id',0)->get();
        $subSubCategories = Category::where("parent_id", $this->category)->where('sub_parent_id',$this->subCategory_id)->get();
        $sizesProducts = Size::where("sub_sub_category_id", $this->sub_sub_category_id)->get();
        $ColorsProducts = ProductsColor::where("sub_sub_category_id", $this->sub_sub_category_id)->get();
        $sellers = Seller::get(['id', 'name']);

        return view('livewire.seller.product.bigDeals.add-big-deals-component', [
            'categories' => $categories,
            'sellersOptions' => $sellers,
            'sizesProducts' => $sizesProducts,
            'subCategories'=>$subCategories,
            'subSubCategories'=>$subSubCategories,
            'ColorsProducts'=>$ColorsProducts
        ])->layout('livewire.seller.layouts.base');
    }
}
