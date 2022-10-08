<?php

namespace App\Http\Livewire\Customer\Quotation;

use App\Models\QuoteNow;
use App\Models\Qutotation;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class QuotationDetailsComponent extends Component
{
    public $sortingValue = 10, $searchTerm;
    public $quotation_id;

    public function mount($id){
        $this->quotation_id = $id;
    }


    public function render()
    {
        $quotation_details = Qutotation::where('id', $this->quotation_id)->first();
        $quote_of_this = QuoteNow::where('quotation_id', $this->quotation_id)->paginate($this->sortingValue);
        $total_quotes = QuoteNow::where('quotation_id', $this->quotation_id)->get()->count();
        return view('livewire.customer.quotation.quotation-details-component',['quotation_details'=>$quotation_details, 'quote_of_this'=>$quote_of_this, 'total_quotes'=>$total_quotes])->layout('livewire.layouts.base');
    }
}
