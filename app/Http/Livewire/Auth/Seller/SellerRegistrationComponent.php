<?php

namespace App\Http\Livewire\Auth\Seller;

use App\Models\Category;
use App\Models\Country;
use App\Models\Seller;
use App\Models\SellerWallet;
use App\Models\Shop;
use App\Models\State;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

class SellerRegistrationComponent extends Component
{
    public $first_name, $last_name, $email, $password, $confirm_password, $shop_name,$shop_address, $phone, $category, $tin, $country_id, $reference_code, $state_id, $company_type, $checkbox;

    public function mount()
    {
        if(Auth::guard('web')->check()){
            $this->first_name = user()->first_name;
            $this->last_name = user()->last_name;
            $this->email = user()->email;
            $this->phone = user()->phone;
        }
        
    }


    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'category' => 'required',
            'company_type' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'email' => 'required|email|unique:sellers',
            'password' => 'required',
            'confirm_password' => 'required',
            'shop_name' => 'required',
            'shop_address' => 'required',
            'checkbox' => 'required',
            'tin' => 'required',
        ],[
            'checkbox.required'=>'You must accept our terms & conditions'
        ]);
    }

    public function signUp()
    {
        if (Auth::guard('web')->check()) {
            $this->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'category' => 'required',
                'company_type' => 'required',
                'country_id' => 'required',
                'state_id' => 'required',
                'email' => 'required|email|unique:sellers',
                'password' => 'required',
                'confirm_password' => 'required',
                'shop_name' => 'required',
                'shop_address' => 'required',
                'checkbox' => 'required',
                'tin' => 'required',
            ],[
                'checkbox.required'=>'You must accept our terms & conditions'
            ]);

            $seller = new Seller();
            $seller->first_name = $this->first_name;
            $seller->last_name = $this->last_name;
            $seller->name = $this->first_name.' '.$this->last_name;
            $seller->email = $this->email;
            $seller->phone = $this->phone;
            $seller->password = user()->password;
            $seller->save();

            $wallet = new SellerWallet();
            $wallet->seller_id = $seller->id;
            $wallet->save();

            $shop = new Shop();
            $shop->seller_id = $seller->id;
            $shop->name = $this->shop_name;
            $shop->slug = Str::slug($this->shop_name).'-'.Str::random(4);
            $shop->address = $this->shop_address;

            $shop->category_id = $this->category;
            $shop->company_type = $this->company_type;
            $shop->tin = $this->tin;
            $shop->country_id = $this->country_id;
            $shop->state_id = $this->state_id;
            $shop->reference_code = $this->reference_code;
            $shop->verification_status = 0;

            $shop->save();
            Auth::guard('seller')->login($seller);

            $this->dispatchBrowserEvent('success', ['message' => 'Registration Successfull']);
            return redirect()->route('seller.home');
        } else {
            $this->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'category' => 'required',
                'company_type' => 'required',
                'country_id' => 'required',
                'state_id' => 'required',
                'email' => 'required|email|unique:sellers',
                'password' => 'required',
                'confirm_password' => 'required',
                'shop_name' => 'required',
                'shop_address' => 'required',
                'tin' => 'required',
                'checkbox' => 'required',
            ],[
                'checkbox.required'=>'You must accept our terms & conditions'
            ]);

            $seller = new Seller();
            $seller->first_name = $this->first_name;
            $seller->last_name = $this->last_name;
            $seller->name = $this->first_name.' '.$this->last_name;
            $seller->email = $this->email;
            $seller->phone = $this->phone;
            $seller->password = Hash::make($this->password);
            $seller->save();

            $wallet = new SellerWallet();
            $wallet->seller_id = $seller->id;
            $wallet->save();

            $shop = new Shop();
            $shop->seller_id = $seller->id;
            $shop->name = $this->shop_name;
            $shop->slug = Str::slug($this->shop_name).'-'.Str::random(4);
            $shop->address = $this->shop_address;

            $shop->category_id = $this->category;
            $shop->company_type = $this->company_type;
            $shop->tin = $this->tin;
            $shop->country_id = $this->country_id;
            $shop->state_id = $this->state_id;
            $shop->reference_code = $this->reference_code;
            $shop->verification_status = 0;

            $shop->save();
            Auth::guard('seller')->attempt(['email' => $this->email, 'password' => $this->password]);

            $this->dispatchBrowserEvent('success', ['message' => 'Registration Successfull']);
            return redirect()->route('seller.home');
        }
    }

    public function render()
    {

        $categories = Category::where('parent_id', 0)->where('sub_parent_id', 0)->get();
        $countries = Country::all();
        $states = State::where('country_id', $this->country_id)->get();

        if (Auth::guard('web')->check()) {
            $seller = Seller::where('email', user()->email)->first();
            if ($seller != '') {
                abort('404');
            } else {
                return view('livewire.auth.seller.seller-registration-component', ['categories'=>$categories, 'countries'=>$countries, 'states'=>$states])->layout('livewire.layouts.base');
            }
        } else {
            return view('livewire.auth.seller.seller-registration-component',['categories'=>$categories, 'countries'=>$countries, 'states'=>$states])->layout('livewire.layouts.base');
        }
    }
}
