<?php

namespace App\Http\Livewire\Admin\Careers;

use App\Models\Career;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class JobApplicationComponent extends Component
{
    use WithPagination;

    public $sortingValue = 10, $searchTerm;
    public $delete_id;
    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }



    public function deleteData()
    {
        $data = JobApplication::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('CareerDeleted');
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->subject);
    }
    public function export()
    {
        Storage::disk('exports')->download('export.csv');
    }

//    public function publishStatus($id)
//    {
//        $data = Career::find($id);
//        if($data->status == 1){
//            $data->status = 0;
//        }
//        else{
//            $data->status = 1;
//        }
//        $data->save();
//
//        $this->dispatchBrowserEvent('success', ['message'=>'Job status updated successfully']);
//    }

    public function render()
    {
        $jobs = JobApplication::where('name', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('phone', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('description', 'LIKE', '%' . $this->searchTerm . '%')->orderBy('created_at', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.careers.job-application-component', ['jobs'=>$jobs])->layout('livewire.admin.layouts.base');
    }
}
