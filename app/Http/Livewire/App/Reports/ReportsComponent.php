<?php

namespace App\Http\Livewire\App\Reports;

use App\Models\ReportMap;
use Livewire\Component;

class ReportsComponent extends Component
{
    public function render()
    {
        $maps = ReportMap::where('status', 1)->get();

        return view('livewire.app.reports.reports-component', ['maps'=>$maps])->layout('livewire.layouts.base');
    }
}
