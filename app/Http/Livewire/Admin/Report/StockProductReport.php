<?php

namespace App\Http\Livewire\Admin\Report;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class StockProductReport extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm, $delete_id;
    public $stock_category_filter;

    public function render()
    {
        $stockProductReport = Product::where('id','!=','');
        if($this->stock_category_filter != ''){
            $stockProductReport = $stockProductReport->where('category_id', $this->stock_category_filter);
        }

        $productCategory = Category::all();
        $stockProduct = $stockProductReport->orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.report.stock-product-report', ['stockProduct' => $stockProduct, 'productCategory' => $productCategory])->layout('livewire.admin.layouts.base');
    }
}
