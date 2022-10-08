<?php

namespace App\Http\Livewire\App\Careers;

use App\Models\Career;
use Livewire\Component;
use Livewire\WithPagination;

class CareersComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;

    public function render()
    {
        $careers = Career::orderBy('created_at', 'DESC')->where('status', 1)->where('subject', 'like', '%'.$this->searchTerm.'%')->paginate($this->sortingValue);
        return view('livewire.app.careers.careers-component', ['careers'=>$careers])->layout('livewire.layouts.base');
    }
}
