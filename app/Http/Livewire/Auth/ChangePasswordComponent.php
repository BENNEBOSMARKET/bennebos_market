<?php

namespace App\Http\Livewire\Auth;

use App\Models\PasswordResetLink;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePasswordComponent extends Component
{
    public $link, $email, $password, $confirm_password;

    public function mount()
    {
        $getLink = PasswordResetLink::where('token', request()->get('token'))->first();
        if($getLink){
            if($getLink->status == 1 || $getLink->validity < Carbon::now()){
                abort(404);
            }
            else{
                $this->link = $getLink;
            }
        }
        else{
            abort(404);
        }
        
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email'=>'required|email',
            'password'=>'required|min:8|max:35',
            'confirm_password'=>'required|min:8|max:35|same:password',
        ]);
    }

    public $status = 0;
    public function updatePassword()
    {
        $this->validate([
            'email'=>'required|email',
            'password'=>'required|min:8|max:35',
            'confirm_password'=>'required|min:8|max:35|same:password',
        ]);

        if($this->email == $this->link->email){
            $user = User::where('email', $this->email)->first();
            $user->password = Hash::make($this->password);
            $user->save();

            $this->status = 1;

            $this->email = '';
            $this->password = '';
            $this->confirm_password = '';

            $link = PasswordResetLink::where('id', $this->link->id)->first();
            $link->status = 1;
            $link->save();
        }
        else{
            $this->dispatchBrowserEvent('error', ['message'=>'Incorrect email address']);
        }
    }

    public function render()
    {
        return view('livewire.auth.change-password-component')->layout('livewire.layouts.base');
    }
}
