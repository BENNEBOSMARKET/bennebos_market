<?php

namespace App\Http\Livewire\Admin\Product\Size;

use Livewire\Component;
use App\Models\SizeRequest;

class SizeRequestsComponent extends Component
{
    public $sortingValue = 10;
    public function render()
    {
        $requests = SizeRequest::paginate($this->sortingValue);

        return view('livewire.admin.product.size.size-requests-component', ['requests'=>$requests])->layout('livewire.admin.layouts.base');
    }
}
