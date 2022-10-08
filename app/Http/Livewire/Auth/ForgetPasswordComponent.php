<?php

namespace App\Http\Livewire\Auth;

use App\Models\PasswordResetLink;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;

class ForgetPasswordComponent extends Component
{
    public $email;
    public function forgetPassword()
    {
        $this->validate([
            'email'=>'required|email',
        ]);

        $getUser = User::where('email', $this->email)->first();
        if($getUser){

            $token = Str::random(25) . uniqid() . time();
            $link = url('/').'/change-password/confirm?token=' . $token;

            $data = new PasswordResetLink();
            $data->user_id = $getUser->id;
            $data->user_type = 'customer';
            $data->email = $this->email;
            $data->token = $token;
            $data->link = $link;
            $data->validity = Carbon::now()->addMinutes(15);
            $data->save();

            $mailData['email'] = $this->email;
            $mailData['link'] = $link;

            Mail::send('emails.forget-password', $mailData, function($message) use ($mailData) {
                $message->to($mailData['email'])
                ->subject('Reset Password');
            });

            $this->email = '';

            $this->dispatchBrowserEvent('linkMailSent');
        }
        else{
            session()->flash('error_email');
        }
        
    }

    public function render()
    {
        return view('livewire.auth.forget-password-component')->layout('livewire.layouts.base');
    }
}
