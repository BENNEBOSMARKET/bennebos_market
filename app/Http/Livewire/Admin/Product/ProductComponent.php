<?php

namespace App\Http\Livewire\Admin\Product;

use App\Imports\ProductImport;
use App\Imports\ProductImportV2;
use App\Models\Product;
use App\Models\ProductImage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ProductComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $excel;

    public $sortingValue = 10, $searchTerm, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function publishAll()
    {
        $products = Product::where('status', 0)->get();
        foreach($products as $product){
            $product = Product::where('id', $product->id)->first();
            $product->status = 1;
            $product->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'All product published']);
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = Product::find($this->delete_id);
        $data->delete();

        $images = ProductImage::where('product_id', $this->delete_id)->get();
        foreach($images as $image){
            $img = ProductImage::where('id', $image->id)->first();
            $img->delete();
        }

        $this->dispatchBrowserEvent('productDeleted');

        $this->delete_id = '';
    }

    public function publishStatus($id)
    {
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

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'excel'=>'required',
        ]);
    }

    public function uploadExcel()
    {
        $this->validate([
            'excel'=>'required',
        ]);

        Excel::import(new ProductImport, $this->excel);

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Products imported successfully!']);

        $this->excel = '';
    }

    public function close()
    {
        $this->excel = '';
    }

    public function render()
    {
        $products = Product::where('name', 'like', '%'.$this->searchTerm.'%')->orderBy('id', 'DESC')->paginate($this->sortingValue);

        return view('livewire.admin.product.product-component', ['products'=>$products])->layout('livewire.admin.layouts.base');
    }
}
