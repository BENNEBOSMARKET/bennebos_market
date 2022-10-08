<?php

namespace App\Http\Livewire\Admin\Careers;

use App\Models\Career;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class CareersComponent extends Component
{
    use WithPagination;
    
    public $subject, $slug, $type, $description, $status;
    public $sortingValue = 10, $searchTerm;
    public $delete_id;
    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function storeData()
    {
        $this->validate([
            'subject'=>'required',
            'slug'=>'required|unique:careers',
            'type'=>'required',
            'description'=>'required',
        ]);
        
        $blog = new Career();
        $blog->subject = $this->subject;
        $blog->slug = $this->slug;
        $blog->type = $this->type;
        $blog->description = $this->description;
     
        $blog->save();
        return redirect()->route('admin.career')->with('success', 'Job posted successfully');
    }

    public function deleteData()
    {
        $data = Career::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('CareerDeleted');
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->subject);
    }

    public function publishStatus($id)
    {
        $data = Career::find($id);
        if($data->status == 1){
            $data->status = 0;
        }
        else{
            $data->status = 1;
        }
        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Job status updated successfully']);
    }

    public function render()
    {
        $careers = Career::orderBy('created_at', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.careers.careers-component', ['careers'=>$careers])->layout('livewire.admin.layouts.base');
    }
}
