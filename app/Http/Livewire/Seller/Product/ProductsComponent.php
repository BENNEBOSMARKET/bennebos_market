<?php

namespace App\Http\Livewire\Seller\Product;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsComponent extends Component
{
    use WithPagination;
    public $categories, $sortCategory, $searchTerm, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteProduct'];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteProduct()
    {
        $product = Product::where('id', $this->delete_id)->first();
        $product->delete();

        $this->dispatchBrowserEvent('productDeleted');
    }

    public function publishStatus($id)
    {
        $verification_status = Shop::where('seller_id', authSeller()->id)->first()->verification_status;

        if($verification_status == '1'){
            $getProduct = Product::where('id', $id)->first();
            if($getProduct->status == 0){
                $getProduct->status = 1;
                $getProduct->save();
            }
            else{
                $getProduct->status = 0;
                $getProduct->save();
            }

            $this->dispatchBrowserEvent('success', ['message'=>'Product updated successfully']);
        }
        else{
            $this->dispatchBrowserEvent('error', ['message'=>'Your shop is not verified!']);
        }
        
    }

    public function render()
    {
        DB::statement("SET SQL_MODE=''");
        $sortedproducts = Product::where('id', '!=', '');

        if($this->sortCategory != ''){
            $sortedproducts = $sortedproducts->where('category_id', $this->sortCategory);
        }

        $products = $sortedproducts->where('user_id', authSeller()->id)->where('name', 'like', '%'.$this->searchTerm.'%')->orderBy('created_at', 'DESC')->paginate(15);

        $this->categories = Product::where('user_id', authSeller()->id)->groupBy('category_id')->get();

        return view('livewire.seller.product.products-component', ['products'=>$products])->layout('livewire.seller.layouts.base');
    }
}
