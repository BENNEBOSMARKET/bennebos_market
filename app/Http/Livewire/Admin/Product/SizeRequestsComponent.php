<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\SizeRequest;
use Livewire\Component;

class SizeRequestsComponent extends Component
{
    public $sortingValue = 10;
    public function render()
    {
        $requests = SizeRequest::paginate($this->sortingValue);

        return view('livewire.admin.product.size-requests-component', ['requests'=>$requests])->layout('livewire.admin.layouts.base');
    }
}
