<?php

namespace App\Http\Livewire\Seller\Shop;

use App\Models\Seller;
use App\Models\ShopVerification;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShopVerificationComponent extends Component
{
    public $name, $shop_name, $email, $licence_no, $full_address, $phone, $taxpapers = [], $checkbox;
    use WithFileUploads;

    public function mount()
    {
        $this->name = authSeller()->name;
        $this->shop_name = shop(authSeller()->id)->name;
        $this->email = authSeller()->email;
        $this->full_address = shop(authSeller()->id)->address;
        $this->phone = authSeller()->phone;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'shop_name' => 'required',
            'email' => 'required|email',
            'licence_no' => 'required',
            'full_address' => 'required',
            'phone' => 'required',
            'taxpapers' => 'required',
            'checkbox' => 'required|min:1|max:1',
        ],[
            'checkbox.*'=>'You must accept the terms & conditions',
        ]);
    }

    public function applyVerification()
    {
        $this->validate([
            'name' => 'required',
            'shop_name' => 'required',
            'email' => 'required|email',
            'licence_no' => 'required',
            'full_address' => 'required',
            'phone' => 'required',
            'taxpapers' => 'required',
            'checkbox' => 'required|min:1|max:1',
        ],[
            'checkbox.*'=>'You must accept the terms & conditions',
        ]);

        if(authSeller()->application_status == 1){
            $this->dispatchBrowserEvent('error', ['message'=>'You have already applied for verification.']);
        }
        else{
            $verification = new ShopVerification();
            $verification->seller_id = authSeller()->id;
            $verification->name = $this->name;
            $verification->shop_name = $this->shop_name;
            $verification->email = $this->email;
            $verification->license_no = $this->licence_no;
            $verification->address = $this->full_address;
            $verification->phone = $this->phone;

            if($this->taxpapers != ''){
                $files = [];
                foreach($this->taxpapers as $key => $taxpaper){
                    $fileName = Carbon::now()->timestamp . $key . '.' . $this->taxpapers[$key]->extension();
                    $this->taxpapers[$key]->storeAs('imgs/documents', $fileName, 's3');
                    $files[] = $fileName;
                }
            }
            $verification->tax_papers = json_encode($files);
            $verification->save();

            $seller = Seller::where('id', authSeller()->id)->first();
            $seller->application_status = 1;
            $seller->save();

            session()->flash('success', 'Verification Request Sent Successfully');
            return redirect()->route('seller.home');

            $this->name = '';
            $this->shop_name = '';
            $this->email = '';
            $this->licence_no = '';
            $this->full_address = '';
            $this->phone = '';
            $this->taxpapers = '';
        }
    }

    public function render()
    {
        return view('livewire.seller.shop.shop-verification-component')->layout('livewire.seller.layouts.base');
    }
}
