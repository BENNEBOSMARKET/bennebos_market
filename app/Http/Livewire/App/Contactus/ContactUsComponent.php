<?php

namespace App\Http\Livewire\App\Contactus;

use App\Models\ContactUs;
use Livewire\Component;

class ContactUsComponent extends Component
{
    public $name, $phone, $email, $subject, $message;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = new ContactUs();
        $data->name = $this->name;
        $data->phone = $this->phone;
        $data->email = $this->email;
        $data->subject = $this->subject;
        $data->message = $this->message;

        $data->save();
        session()->flash('message', 'Thank you! Your message has been successfully sent. We will contact you very soon!');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->subject = '';
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.app.contactus.contact-us-component')->layout('livewire.layouts.base');
    }
}
