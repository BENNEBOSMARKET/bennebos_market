<?php

namespace App\Http\Livewire\Admin\Cms;

use App\Models\Searches;
use Livewire\Component;
use Livewire\WithPagination;

class SearchComponent extends Component
{
    use WithPagination;

    public $sortingValue = 10, $searchTerm;
    public $delete_id;
    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function deleteData()
    {
        $data = Searches::find($this->delete_id);
        $data->delete();
        $this->dispatchBrowserEvent('SearchDeleted');
    }

    public function render()
    {
        $recent_searchs = Searches::orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.cms.search-component', ['recent_searchs'=>$recent_searchs])->layout('livewire.admin.layouts.base');
    }
}
