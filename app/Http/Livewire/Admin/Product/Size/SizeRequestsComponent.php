<?php

namespace App\Http\Livewire\Admin\Product\Size;

use Livewire\Component;
use App\Models\SizeRequest;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SizeRequestsComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $sortingValue = 10;
    public function render()
    {
        $requests = SizeRequest::paginate($this->sortingValue);

        return view('livewire.admin.product.size.size-requests-component', ['requests'=>$requests])->layout('livewire.admin.layouts.base');
    }
}
