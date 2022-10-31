<?php

namespace App\Http\Livewire\Admin\PendingProduct;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class PendingProductComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm, $delete_id;

    public function publishStatus($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->admin_approval == 0){
            $getProduct->admin_approval = 1;
            $getProduct->save();
        }
        else{
            $getProduct->admin_approval = 0;
            $getProduct->save();
        }
        $this->dispatchBrowserEvent('success', ['message'=>'Product approved successfully']);
    }
    public function publishAll(){
        Product::where('admin_approval',0)->update(['admin_approval' => 1]);
        $this->dispatchBrowserEvent('success', ['message'=>'Products approved successfully']);
    }

    public function render()
    {
        $pending_products = Product::where('name', 'like', '%'.$this->searchTerm.'%')
        ->where('admin_approval', 0)->orderBy('id', 'DESC')->paginate($this->sortingValue);




        return view('livewire.admin.pending-product.pending-product-component', ['pending_products' => $pending_products])->layout('livewire.admin.layouts.base');
    }
}
