<?php

namespace App\Http\Livewire\Seller\Product\BigDeals;

use App\Models\BigDealsPhoto;
use App\Models\BigDealsProduct;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BigDealsProductComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $sortingValue = 10, $searchTerm, $delete_id;
    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = BigDealsProduct::find($this->delete_id);
        $data->delete();

        $images = BigDealsPhoto::where('bigDealsPhoto_id', $this->delete_id)->get();
        foreach($images as $image){
            $img = BigDealsPhoto::where('id', $image->id)->first();
            $img->delete();
        }

        $this->dispatchBrowserEvent('productDeleted');

        $this->delete_id = '';
    }

    public function render()
    {
        $bigDeals=BigDealsProduct::where('seller_id',authSeller()->id)->orderBy('created_at','desc')->paginate($this->sortingValue);

        return view('livewire.seller.product.bigDeals.big-deals-component', [
            'bigDeals' => $bigDeals,
        ])->layout('livewire.seller.layouts.base');
    }
}
