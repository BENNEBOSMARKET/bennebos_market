<?php

namespace App\Http\Livewire\Admin\Marketing;

use App\Models\Subscriber;
use Livewire\Component;
use Livewire\WithPagination;

class SubscriberComponent extends Component
{
    use WithPagination;

    public $sortingValue = 10, $searchTerm, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = Subscriber::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('subscriberDeleted');
    }

    public function render()
    {
        $subscribers = Subscriber::where('email', 'like', '%'.$this->searchTerm.'%')->orWhere('created_at', 'like', '%'.$this->searchTerm.'%')->paginate($this->sortingValue);

        return view('livewire.admin.marketing.subscriber-component', ['subscribers'=>$subscribers])->layout('livewire.admin.layouts.base');
    }
}
