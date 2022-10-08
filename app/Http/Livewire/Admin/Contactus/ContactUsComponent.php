<?php

namespace App\Http\Livewire\Admin\Contactus;

use App\Models\ContactUs;
use Livewire\Component;

class ContactUsComponent extends Component
{
    public $sortingValue = 10, $searchTerm, $delete_id;

    public function render()
    {
        $contactMessages = ContactUs::orderBy('id', 'DESC')->paginate($this->sortingValue);

        return view('livewire.admin.contactus.contact-us-component', ['contactMessages'=>$contactMessages])->layout('livewire.admin.layouts.base');
    }
}
