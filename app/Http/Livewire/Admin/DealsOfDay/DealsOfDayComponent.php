<?php

namespace App\Http\Livewire\Admin\DealsOfDay;

use App\Models\Product;
use Livewire\Component;
use App\Models\DealsOfDay;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class DealsOfDayComponent extends Component
{
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;
    public $product_id, $date_from, $date_to, $status, $discount, $stock;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function publishStatus($id)
    {
        $getDeals = DealsOfDay::where('id', $id)->first();

        if($getDeals->status == 0){
            $getDeals->status = 1;
            $getDeals->save();
        }
        else{
            $getDeals->status = 0;
            $getDeals->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Published reviews updated successfully']);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'product_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'product_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
        ]);

        $product = Product::find($this->product_id);
        $product->deal_of_day = 1;
        $product->save();

        $getProduct = DealsOfDay::where('product_id', $this->product_id)->get();

        if($getProduct->count() > 0){
            $this->dispatchBrowserEvent('error', ['message'=>'Product already added!']);
        }
        else{
            $data = new DealsOfDay();
            $data->product_id = $this->product_id;
            $data->date_from = $this->date_from;
            $data->date_to = $this->date_to;

            $data->save();

            $this->dispatchBrowserEvent('success', ['message'=>'Deals created successfully']);
            $this->dispatchBrowserEvent('closeModal');
            $this->resetInputs();
        }
    }

    // public function editData($id)
    // {
    //     $getData = DealsOfDay::where('id', $id)->first();

    //     $this->edit_id = $getData->id;
    //     $this->product_id = $getData->id;
    //     $this->date_from = date("Y-m-d\TH:i:s", strtotime($getData->date_from));
    //     $this->date_to = date("Y-m-d\TH:i:s", strtotime($getData->date_to));
    //     $this->dispatchBrowserEvent('showEditModal');
    // }

    // public function updateData()
    // {
    //     $this->validate([
    //         'product_id' => 'required',
    //         'date_from' => 'required',
    //         'date_to' => 'required',
    //     ]);


    //     $data = DealsOfDay::where('id', $this->edit_id)->first();
    //     $data->product_id = $this->product_id;
    //     $data->date_from = $this->date_from;
    //     $data->date_to = $this->date_to;

    //     $data->save();
    //     $this->dispatchBrowserEvent('closeModal');
    //     $this->dispatchBrowserEvent('success', ['message'=>'Deals updated successfully']);

    //     $this->resetInputs();

    // }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = DealsOfDay::find($this->delete_id);

        $product = Product::find($data->product_id);
        $product->deal_of_day = 0;
        $product->save();

        $data->delete();

        $this->dispatchBrowserEvent('DealsDeleted');

        $this->delete_id = '';
    }

    public function resetInputs()
    {
        $this->product_id = '';
        $this->date_from = '';
        $this->date_to = '';
        $this->delete_id = '';
        $this->edit_id = '';
    }

    public function render()
    {
        $products = DB::table('products')->select('id','name')->where('deal_of_day', 0)->orderBy('id', 'ASC')->limit(100)->get();
        $dealsofDay = Product::where('deal_of_day', 1)->where('name', 'LIKE', '%' . $this->searchTerm . '%')->orderBy('id', 'DESC')->paginate($this->sortingValue);

        return view('livewire.admin.deals-of-day.deals-of-day-component', ['dealsofDay'=>$dealsofDay, 'products'=>$products])->layout('livewire.admin.layouts.base');
    }
}
