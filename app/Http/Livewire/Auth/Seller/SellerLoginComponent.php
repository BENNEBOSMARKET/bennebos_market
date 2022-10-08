<?php

namespace App\Http\Livewire\Auth\Seller;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class SellerLoginComponent extends Component
{
    public $email, $password;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email'=>'required',
            'password'=>'required',
        ]);
    }

    public function signIn()
    {
        $this->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $getUser = Seller::where('email', $this->email)->first();

        if ($getUser != '') {
            if($getUser->disabled == 0){
                if (Hash::check($this->password, $getUser->password)) {
                    Auth::guard('seller')->attempt(['email' => $this->email, 'password' => $this->password]);
    
                    $this->dispatchBrowserEvent('success', ['message' => 'Login Successful']);
                    return redirect()->route('seller.home');
                } else {
                    session()->flash('errorMessage', 'Invalid email or password');
                }
            }
            else{
                session()->flash('disabledMessage', 'Whoops! Your account has been disabled!');
            }
            
        } else {
            session()->flash('errorMessage', 'Invalid email or password');
        }
    }

    public function render()
    {
        return view('livewire.auth.seller.seller-login-component')->layout('livewire.layouts.base');
    }
}
