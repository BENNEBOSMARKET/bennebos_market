<?php

namespace App\Http\Livewire\Admin\Seller;

use App\Models\DealsOfDay;
use App\Models\Product;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Seller;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class SellerComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $sortingValue = 10, $searchTerm;

    public $delete_id, $disable_id, $enable_id, $seller_id, $url;
    protected $listeners = ['deleteConfirmed' => 'deleteSeller'];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-seller-delete-confirmation');
    }

    public function deleteSeller()
    {
        $seller = Seller::find($this->delete_id);
        $products = Product::where('user_id', $seller->id)->get();
        foreach ($products as $product) {
            $product = Product::find($product->id);
            $product->delete();

            $deals = DealsOfDay::where('product_id', $product->id)->get();
            foreach ($deals as $deal) {
                $data = DealsOfDay::find($deal->id);
                $data->delete();
            }
        }
        $shop = Shop::where('seller_id', $seller->id)->first();
        $shop->delete();

        $seller->delete();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('sellerDeleted');
        $this->delete_id = '';
    }

    //Disable Seller
    public function disableConfirmation($id)
    {
        $this->disable_id = $id;
        $this->dispatchBrowserEvent('show-seller-disable-confirmation');
    }

    public function disableSeller()
    {
        $seller = Seller::find($this->disable_id);
        $products = Product::where('user_id', $seller->id)->get();
        foreach ($products as $product) {
            $product = Product::find($product->id);
            $product->status = 0;
            $product->save();

            $deals = DealsOfDay::where('product_id', $product->id)->get();
            foreach ($deals as $deal) {
                $data = DealsOfDay::find($deal->id);
                $data->delete();
            }
        }
        $shop = Shop::where('seller_id', $seller->id)->first();
        $shop->status = 0;
        $shop->save();

        $seller->disabled = 1;
        $seller->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('sellerDisabled');
        $this->disable_id = '';
    }

    //Enable Seller
    public function enableConfirmation($id)
    {
        $this->enable_id = $id;
        $this->dispatchBrowserEvent('show-seller-enable-confirmation');
    }

    public function enableSeller()
    {
        $seller = Seller::find($this->enable_id);
        $products = Product::where('user_id', $seller->id)->get();
        foreach ($products as $product) {
            $product = Product::find($product->id);
            $product->status = 1;
            $product->save();
        }
        $shop = Shop::where('seller_id', $seller->id)->first();
        $shop->status = 1;
        $shop->save();

        $seller->disabled = 0;
        $seller->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('sellerEnabled');
        $this->enable_id = '';
    }

    public function loginAsSeller($id)
    {
        $getUser = Seller::where('id', $id)->first();

        if ($getUser != '') {
            Auth::guard('seller')->attempt(['email' => $getUser->email, 'password' => $getUser->password]);

            $this->dispatchBrowserEvent('success', ['message' => 'Login Successful']);
            return redirect()->route('seller.home');
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Can not login with this seller!']);
        }
    }

    public function showProfile($seller_id)
    {
        $this->dispatchBrowserEvent('showProfile');

        $this->seller_id = $seller_id;
    }

    public $edit_id, $name, $email, $password, $profile_picture, $uploaded_profile_picture;
    public function editSeller($id)
    {
        $this->edit_id = $id;

        $seller = Seller::find($id);
        $this->name = $seller->name;
        $this->email = $seller->email;
        $this->uploaded_profile_picture = $seller->avatar;

        $this->url = shop($seller->id)->logo;

        $this->dispatchBrowserEvent('close_view_modal');
        $this->dispatchBrowserEvent('show_edit_modal');
    }

    public function updateSeller()
    {
        $seller = Seller::find($this->edit_id);
        $seller->name = $this->name;
        $seller->email = $this->email;
        if ($this->password != '') {
            $seller->password = Hash::make($this->password);
        }
        if ($this->profile_picture != '') {
            $imageName = Carbon::now()->timestamp . '.' . $this->profile_picture->extension();
            $this->profile_picture->storeAs('imgs/profile', $imageName, 's3');
            $seller->avatar = env('AWS_BUCKET_URL') . 'imgs/profile/' . $imageName;
        }
        $seller->save();

        // $shop = Shop::where('seller_id', $this->edit_id)->first();
        // $shop->name = $this->name;
        // $shop->logo = $this->url;
        // $shop->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('sellerUpdated');

        $this->edit_id = '';
    }



    public function render()
    {
        $profile = Seller::find($this->seller_id);
        $sellers = Seller::where('name', 'LIKE', '%' . $this->searchTerm . '%')->orderBy('created_at', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.seller.seller-component', ['sellers' => $sellers, 'profile' => $profile])->layout('livewire.admin.layouts.base');
    }
}
