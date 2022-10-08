<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Models\Admin;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class ProfileComponent extends Component
{
    public $name, $phone, $email, $password, $country, $confirm_password, $avatar, $new_avatar;

    use WithFileUploads;

    public function mount()
    {
        $getData = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        $this->name = $getData->name;
        $this->phone = $getData->phone;
        $this->email = $getData->email;
        $this->country = $getData->country;
        $this->new_avatar = $getData->avatar;
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:admins,email,'.Auth::guard('admin')->user()->id.'',
            'password' => 'min:8|same:confirm_password',
            'confirm_password' => 'min:8'
        ]);

        $profile = Admin::where('id', Auth::guard('admin')->user()->id)->first();
        $profile->name = $this->name;
        $profile->phone = $this->phone;
        $profile->email = $this->email;
        $profile->password = Hash::make('password');
        $profile->country = $this->country;

        if($this->avatar){
            $imageName = Carbon::now()->timestamp. '.' . $this->avatar->extension();
            $this->avatar->storeAs('imgs/profile',$imageName,'s3');
            $profile->avatar = $imageName;
        }
        $profile->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Profile Updated Successfully']);

    }

    public function render()
    {
        $profile = Admin::find(Auth::user()->id);
        return view('livewire.admin.profile.profile-component', ['profile' => $profile])->layout('livewire.admin.layouts.base');
    }
}
