<?php

namespace App\Http\Livewire\Customer\Quotation;

use App\Models\Qutotation;
use Livewire\Component;

class QuotationComponent extends Component
{
    public $sortingValue = 10, $searchTerm;

    public function render()
    {
        $quotations = Qutotation::where('user_id', user()->id)->paginate($this->sortingValue);
        $total_quotations = Qutotation::where('user_id', user()->id)->get()->count();
        return view('livewire.customer.quotation.quotation-component', ['quotations'=>$quotations, 'total_quotations'=>$total_quotations])->layout('livewire.layouts.base');
    }
}
