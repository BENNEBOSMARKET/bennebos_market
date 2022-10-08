<?php

namespace App\Http\Livewire\App\CompanyInfo;

use App\Models\Country;
use App\Models\ReportMap;
use App\Models\ReportMapv2;
use App\Models\State;
use Livewire\Component;

class CompanyMapComponent extends Component
{
    public $country_id, $state, $searchTerm;

    public function selectCountry()
    {
        $this->state = '';
    }

    public function render()
    {
        $maps = ReportMapv2::all();
        return view('livewire.app.company-info.company-map-component', ['maps'=>$maps])->layout('livewire.layouts.base');
    }
}
