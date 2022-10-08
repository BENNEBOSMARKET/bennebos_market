<?php

namespace App\Http\Livewire\Admin\Websitesetup;

use App\Models\WebsiteSetting;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class HeaderSectionComponent extends Component
{
    use WithFileUploads;
    public $logo, $uploadedLogo, $fav_icon, $uploadedFavIcon;

    public function mount()
    {
        $setting = WebsiteSetting::where('id', 1)->first();
        if ($setting != '') {
            $this->uploadedLogo = $setting->header_logo;
            $this->uploadedFavIcon = $setting->fav_icon;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'logo' => 'required_if:uploadedLogo,null',
            'fav_icon' => 'required_if:uploadedFavIcon,null',
        ]);
    }

    public function updateHeader()
    {
        $this->validate([
            'logo' => 'required_if:uploadedLogo,null',
            'fav_icon' => 'required_if:uploadedFavIcon,null',
        ]);

        $setting = WebsiteSetting::where('id', 1)->first();

        if ($this->logo != '') {
            $imageName = Carbon::now()->timestamp . '_logo.' . $this->logo->extension();
            $this->logo->storeAs('imgs/logo', $imageName, 's3');
            $setting->header_logo = env('AWS_BUCKET_URL') . 'imgs/logo/' . $imageName;
        }

        if ($this->fav_icon != '') {
            $favIconName = Carbon::now()->timestamp . '_favicon.' . $this->fav_icon->extension();
            $this->fav_icon->storeAs('imgs/logo', $favIconName, 's3');
            $setting->fav_icon = env('AWS_BUCKET_URL') . 'imgs/logo/' . $favIconName;
        }

        $setting->save();

        $this->dispatchBrowserEvent('success', ['message' => 'Setting updated successfully']);
    }

    public function render()
    {
        return view('livewire.admin.websitesetup.header-section-component')->layout('livewire.admin.layouts.base');
    }
}
