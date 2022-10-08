<?php

namespace App\Http\Livewire\Admin\Report;

use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class InhouseProductReport extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm, $delete_id;
    public $filter_date_range;

    public function render()
    {
        $inhouseReport = Product::where('user_id', 0);
        if($this->filter_date_range != ''){
            $dates = explode(' - ', $this->filter_date_range);
            $start_date = Carbon::parse($dates[0]);
            $end_date = Carbon::parse($dates[1]);

            $inhouseReport = $inhouseReport->whereBetween('created_at', [$start_date, $end_date]);
        }

        $inhouseReports = $inhouseReport->where('added_by', 'admin')->orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.report.inhouse-product-report', ['inhouseReports' => $inhouseReports])->layout('livewire.admin.layouts.base');
    }
}
