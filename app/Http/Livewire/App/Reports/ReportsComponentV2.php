<?php

namespace App\Http\Livewire\App\Reports;

use App\Models\ReportMapv2;
use App\Models\ReportImportCountry;
use App\Models\ReportExportCountry;
use Livewire\Component;

class ReportsComponentV2 extends Component
{
    public $slug, $type, $mapDetails;
    public function mount($slug, $type)
    {
        $this->slug = $slug;
        $this->type = $type;

        $map = ReportMapv2::where('slug', $slug)->first();
        $this->mapDetails = $map;
    }
    public function render()
    {
        $maps = ReportMapv2::all();
        $importCountries = ReportImportCountry::where('report_map_id', $this->mapDetails->id)->get();
        $exportCountries = ReportExportCountry::where('report_map_id', $this->mapDetails->id)->get();

        return view('livewire.app.reports.reports-component-v2', ['maps'=>$maps, 'importCountries'=>$importCountries, 'exportCountries'=>$exportCountries])->layout('livewire.layouts.base');
    }
}
