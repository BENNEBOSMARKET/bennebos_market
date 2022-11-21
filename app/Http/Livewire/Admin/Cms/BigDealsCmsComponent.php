<?php

namespace App\Http\Livewire\Admin\Cms;

use App\Models\BigDealsProduct;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class BigDealsCmsComponent extends Component
{
    public $new_arrival, $top_ranked, $persona_protective, $dropshipping, $global_original_sources, $true_view;

    use WithPagination;
    public $sortingValue = 10, $searchTerm, $delete_id, $sort_category;

    public function bestBigDeal($id)
    {
        $getProduct = BigDealsProduct::where('id', $id)->first();

        if($getProduct->best_big_deal == 0){
            $getProduct->best_big_deal = 1;
            $getProduct->save();
        }
        else{
            $getProduct->best_big_deal = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Right slider added!']);
    }


    public function render()
    {
        $products = DB::table('big_deals_products')->where('name', 'like', '%'.$this->searchTerm.'%')
            ->orderBy('id', 'DESC')->paginate($this->sortingValue);



        return view('livewire.admin.cms.big-deals-cms-component', ['products'=>$products])->layout('livewire.admin.layouts.base');
    }
}
