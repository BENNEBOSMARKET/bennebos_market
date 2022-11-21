<?php

namespace App\Http\Livewire\Admin\Product\BigDeals;

use App\Models\BigDealsPhoto;
use App\Models\BigDealsProduct;
use App\Models\Category;
use App\Models\Country;
use App\Models\ProductsColor;
use App\Models\Seller;
use App\Models\Size;
use App\Traits\FileHandler;
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
        $bigDeals=BigDealsProduct::orderBy('created_at','desc')->paginate($this->sortingValue);

        return view('livewire.admin.product.bigDeals.big-deals-component', [
            'bigDeals' => $bigDeals,
        ])->layout('livewire.admin.layouts.base');
    }
}
