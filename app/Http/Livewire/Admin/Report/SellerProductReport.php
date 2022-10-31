<?php

namespace App\Http\Livewire\Admin\Report;

use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class SellerProductReport extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm, $delete_id;
    public $filter_date_range;

    public function render()
    {
        $sellerReport = Product::where('id','!=','');
        if($this->filter_date_range != ''){
            $dates = explode(' - ', $this->filter_date_range);
            $start_date = Carbon::parse($dates[0]);
            $end_date = Carbon::parse($dates[1]);

            $sellerReport = $sellerReport->whereBetween('created_at', [$start_date, $end_date]);
        }

        $sellerReports = $sellerReport->where('added_by', 'seller')->where('name', 'LIKE', '%' . $this->searchTerm . '%')->orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.report.seller-product-report', ['sellerReports' => $sellerReports])->layout('livewire.admin.layouts.base');
    }
}
