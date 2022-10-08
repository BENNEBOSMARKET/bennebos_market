<?php

namespace App\Http\Livewire\Auth\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email, $password;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email'=>'required',
            'password'=>'required',
        ]);
    }

    public function adminLogin()
    {
        $this->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $getUser = Admin::where('email', $this->email)->first();

        if ($getUser != '') {
            if (Hash::check($this->password, $getUser->password)) {
                Auth::guard('admin')->attempt(['email' => $this->email, 'password' => $this->password]);

                $this->dispatchBrowserEvent('success', ['message' => 'Login Successful']);
                return redirect()->route('admin.home');
            } else {
                session()->flash('errorMessage', 'Invalid email or password');
            }
        } else {
            session()->flash('errorMessage', 'Invalid email or password');
        }
    }

    public function render()
    {
        return view('livewire.auth.admin.login-component')->layout('livewire.auth.admin.auth-base');
    }
}
