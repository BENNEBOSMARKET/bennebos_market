<?php

namespace App\Http\Livewire\Customer\Profile;

use App\Models\Country;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileComponent extends Component
{
    public $first_name, $last_name, $phone, $phonecode = 90, $prefix_code, $gender, $email, $country, $avatar, $new_avatar;

    use WithFileUploads;

    public function mount()
    {
        $getData = User::where('id', Auth::user()->id)->first();

        $this->first_name = $getData->first_name;
        $this->last_name = $getData->last_name;
        $this->phone = $getData->phone;
        $this->phonecode = $getData->phonecode;
        $this->prefix_code = $getData->prefix_code;
        $this->email = $getData->email;
        $this->country = $getData->country;
        $this->new_avatar = $getData->avatar;
        $this->gender = $getData->gender;
    }

    public function storeData()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email,'.Auth::user()->id.'',
            'phone' => 'required',
            'phonecode' => 'required',
        ]);

        $profile = User::where('id', Auth::user()->id)->first();
        $profile->first_name = $this->first_name;
        $profile->last_name = $this->last_name;
        $profile->name = $this->first_name.' '.$this->last_name;
        $profile->phone = $this->phone;
        $profile->phonecode = $this->phonecode;
        $profile->email = $this->email;
        $profile->country = $this->country;
        $profile->gender = $this->gender;
        $profile->password = Hash::make('password');

        if($this->avatar!=null){
            $imageName = Carbon::now()->timestamp. '.' . $this->avatar->extension();
            $this->avatar->storeAs('imgs/profile',$imageName, 's3');
            $profile->avatar = env('AWS_BUCKET_URL') . 'imgs/profile/'.$imageName;
        }
        $profile->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Profile Updated Successfully']);
    }

    public $password, $confirm_password, $current_password;

    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required|min:8'
        ]);

        if(Hash::check($this->current_password, user()->password)){
            $setting = User::where('id', Auth::user()->id)->first();
            $setting->password = Hash::make($this->password);
            $setting->save();
            $this->dispatchBrowserEvent('success', ['message'=>'Password Updated Successfully']);

            $this->current_password = '';
            $this->password = '';
            $this->confirm_password = '';
        }else{
            $this->dispatchBrowserEvent('error', ['message'=>'Your Current Password is incorrect!']);
        }
    }

    public function render()
    {
        $countries = Country::all();

        $profile = User::find(Auth::user()->id);
        return view('livewire.customer.profile.profile-component', ['profile' => $profile, 'countries'=>$countries])->layout('livewire.layouts.base');
    }
}
