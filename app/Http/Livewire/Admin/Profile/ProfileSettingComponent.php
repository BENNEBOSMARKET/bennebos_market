<?php

namespace App\Http\Livewire\Admin\Profile;

use Carbon\Carbon;
use App\Models\Admin;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileSettingComponent extends Component
{
    public $name, $email, $phone, $new_password, $confirm_password, $avatar, $uploadedAvatar;

    use WithFileUploads;

    public function mount()
    {
        $setting = Admin::where('id', admin()->id)->first();
        if ($setting != '') {
            $this->name = $setting->name;
            $this->email = $setting->email;
            $this->phone = $setting->phone;
            $this->uploadedAvatar = $setting->avatar;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'avatar' => 'required_if:uploadedAvatar,null',
        ]);
    }

    public function updateHeader()
    {
        if ($this->new_password != '') {
            $this->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'avatar' => 'required_if:uploadedAvatar,null',
                'new_password' => 'min:8|same:confirm_password'
            ]);
        } else {
            $this->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'avatar' => 'required_if:uploadedAvatar,null',
                'new_password' => 'same:confirm_password'
            ]);
        }

        $admin = Admin::where('id', admin()->id)->first();
        $admin->name = $this->name;
        $admin->phone = $this->phone;
        if ($this->avatar) {
            $imageName = Carbon::now()->timestamp . '.' . $this->avatar->extension();
            $this->avatar->storeAs('imgs/profile', $imageName, 's3');
            $admin->avatar = env('AWS_BUCKET_URL') . 'imgs/profile/' . $imageName;
        }

        if ($this->new_password != '') {
            $admin->password = Hash::make($this->new_password);
        }

        $admin->save();

        $this->dispatchBrowserEvent('success', ['message' => 'Profile updated successfully']);
    }


    public function render()
    {
        return view('livewire.admin.profile.profile-setting-component')->layout('livewire.admin.layouts.base');
    }
}
