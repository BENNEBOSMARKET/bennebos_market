<?php

namespace App\Http\Livewire\Seller\Shop;

use App\Models\Country;
use App\Models\County;
use App\Models\Seller;
use App\Models\Shop;
use App\Models\State;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ShopProfileComponent extends Component
{
    use WithFileUploads;

    public $name, $logo, $uploaded_logo, $banner, $uploaded_banner, $address, $facebook,
     $twitter, $google,$country_id, $state_id, $county_id, $phone, $youtube, $description, $meta_description, $shipping_cost, $shop_id, $slug, $gallery = [], $uploaded_gallery = [];

     public function mount(){
        $shop = Shop::where('seller_id', authSeller()->id)->first();

        $this->name = $shop->name;
        $this->slug = $shop->slug;
        $this->address = $shop->address;
        $this->facebook = $shop->facebook;
        $this->twitter = $shop->twitter;
        $this->google = $shop->google;
        $this->youtube = $shop->youtube;
        $this->description = $shop->description;
        $this->meta_description = $shop->meta_description;
        $this->shipping_cost = $shop->shipping_cost;
        $this->uploaded_logo = $shop->logo;
        $this->uploaded_banner = $shop->banner;
        $this->country_id = $shop->country_id;
        $this->phone = authSeller()->phone;
        $this->state_id = $shop->state_id;
        $this->uploaded_gallery = json_decode($shop->gallery);
        $this->shop_id = $shop->id;
        $this->county_id = $shop->county_id;
        
    }

     public function generateslug()
     {
         $this->slug = Str::slug($this->name).'-'.Str::random(4);
     }

     public function removeGallery($key)
     {
         unset($this->gallery[$key]);
     }

     public function deleteGallery($key)
     {
         unset($this->uploaded_gallery[$key]);
     }

     public function updateShop()
     {
         $this->validate([
             'name'=>'required',
             'address'=>'required',
             "phone" => "required|regex:/(05)[0-9]{9}/"
         ],["phone.regex" => "The phone must be a turkish number and starts with 05 and have 11 digits"]);
 
         $shop = Shop::where('id', $this->shop_id)->first();
         $shop->name = $this->name;
         $shop->slug = $this->slug;
         $shop->address = $this->address;
         $shop->facebook = $this->facebook;
         $shop->twitter = $this->twitter;
         $shop->google = $this->google;
         $shop->youtube = $this->youtube;
         $shop->description = $this->description;
         $shop->meta_description = $this->meta_description;
         $shop->shipping_cost = $this->shipping_cost;
         $shop->country_id = $this->country_id;
         $shop->state_id = $this->state_id;
         $shop->county_id = $this->county_id;

         if($this->logo != ''){
            $imageName = Carbon::now()->timestamp. 'logo.' . $this->logo->extension();
            $this->logo->storeAs('shop',$imageName, 's3');
            $shop->logo = env('AWS_BUCKET_URL') . 'imgs/shop/'.$imageName;
        }

        if($this->banner != ''){
            $imageName = Carbon::now()->timestamp. 'banner.' . $this->banner->extension();
            $this->banner->storeAs('imgs/shop',$imageName, 's3');
            $shop->banner = env('AWS_BUCKET_URL') . 'imgs/shop/'.$imageName;
        }
        if($this->gallery){
            foreach($this->gallery as $key => $gitem){
                $imageName = Carbon::now()->timestamp. 'gallery.' .Str::random(10). $this->gallery[$key]->extension();
                $this->gallery[$key]->storeAs('imgs/shop',$imageName, 's3');
                $this->uploaded_gallery[] = env('AWS_BUCKET_URL') . 'imgs/shop/'.$imageName;
            }
            $shop->gallery = json_encode(array_values($this->uploaded_gallery));
        }
        
        $shop->save();
        Seller::where("id",$shop->seller_id)->update(['phone' => $this->phone]);
        $this->gallery = '';
        $this->dispatchBrowserEvent('success', ['message'=>'Shop Profile Updated Successfully']);
    }
    public function render()
    {
        $countries = Country::all();
        $states = State::where('country_id', $this->country_id)->get();
        $counties = County::where('state_id', $this->state_id)->get();
        return view('livewire.seller.shop.shop-profile-component',['countries'=>$countries, 'states'=>$states,"counties" => $counties])->layout('livewire.seller.layouts.base');
    }
}
