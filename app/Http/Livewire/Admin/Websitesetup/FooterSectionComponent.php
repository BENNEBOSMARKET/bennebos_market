<?php

namespace App\Http\Livewire\Admin\Websitesetup;

use App\Models\WebsiteSetting;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class FooterSectionComponent extends Component
{
    use WithFileUploads;
    public $logo, $uploadedLogo, $facebook_url, $twitter_url, $whatsapp_url, $linkedin_url;

    public function mount()
    {
        $setting = WebsiteSetting::where('id', 1)->first();
        if($setting != ''){
            $this->uploadedLogo = $setting->footer_logo;
            $this->facebook_url = $setting->facebook_url;
            $this->twitter_url = $setting->twitter_url;
            $this->whatsapp_url = $setting->whatsapp_url;
            $this->linkedin_url  = $setting->linkedin_url ;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'logo'=>'required_if:uploadedLogo,null',
            'facebook_url'=>'required',
            'twitter_url'=>'required',
            'whatsapp_url'=>'required',
            'linkedin_url'=>'required',
        ]);
    }

    public function updateHeader()
    {
        $this->validate([
            'logo'=>'required_if:uploadedLogo,null',
            'facebook_url'=>'required',
            'twitter_url'=>'required',
            'whatsapp_url'=>'required',
            'linkedin_url'=>'required',
        ]);

        $setting = WebsiteSetting::where('id', 1)->first();

        if($this->logo != ''){
            $imageName = Carbon::now()->timestamp. '.' . $this->logo->extension();
            $this->logo->storeAs('imgs/logo',$imageName, 's3');
            $setting->footer_logo = env('AWS_BUCKET_URL') . 'imgs/logo/'.$imageName;
        }
        $setting->facebook_url = $this->facebook_url;
        $setting->twitter_url = $this->twitter_url;
        $setting->whatsapp_url = $this->whatsapp_url;
        $setting->linkedin_url = $this->linkedin_url;
        $setting->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Setting updated successfully']);
    }

    public function render()
    {
        return view('livewire.admin.websitesetup.footer-section-component')->layout('livewire.admin.layouts.base');
    }
}
