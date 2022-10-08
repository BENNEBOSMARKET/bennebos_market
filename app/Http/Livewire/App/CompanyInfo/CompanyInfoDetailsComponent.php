<?php

namespace App\Http\Livewire\App\CompanyInfo;

use App\Models\CompanyInfo;
use Livewire\Component;

class CompanyInfoDetailsComponent extends Component
{

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $companyDetails = CompanyInfo::where('id', $this->id)->first();
        return view('livewire.app.company-info.company-info-details-component', ['companyDetails'=>$companyDetails])->layout('livewire.layouts.base');
    }
}
