<?php

namespace App\Http\Livewire\Admin\Contactus;

use App\Models\ContactUs;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ContactUsComponent extends Component
{
    use WithPagination;
    use WithFileUploads;


    public $sortingValue = 10, $searchTerm, $delete_id;

    public function render()
    {
        $contactMessages = ContactUs::
            where('name', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('phone', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'LIKE', '%' . $this->searchTerm . '%')

            ->orWhere('subject', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('message', 'LIKE', '%' . $this->searchTerm . '%')->orderBy('id', 'DESC')->paginate($this->sortingValue);

        return view('livewire.admin.contactus.contact-us-component', ['contactMessages'=>$contactMessages])->layout('livewire.admin.layouts.base');
    }
}
