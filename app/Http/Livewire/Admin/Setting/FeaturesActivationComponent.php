<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\SettingFeatureActivation;
use Livewire\Component;

class FeaturesActivationComponent extends Component
{
    public $facebook_login = 0, $google_login = 0, $twitter_login = 0, $app_debug;

    public function mount()
    {
        
    }

    public function socialLoginStatus($value)
    {
        $getData = SettingFeatureActivation::where('id', 1)->first();

        if($getData != ''){
            $data = $getData;
        }
        else{
            $data = new SettingFeatureActivation();
        }

        if($value == 'facebook'){
            if($this->facebook_login == 0){
                $data->facebook_login = 1;
            }
            else{
                $data->facebook_login = 0;
            }
            $data->save();
        }

        if($value == 'google'){
            if($this->google_login == 0){
                $data->google_login = 1;
            }
            else{
                $data->google_login = 0;
            }
            $data->save();
        }

        if($value == 'twitter'){
            if($this->twitter_login == 0){
                $data->twitter_login = 1;
            }
            else{
                $data->twitter_login = 0;
            }
            $data->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Setting updated successfully']);
    }

    public function appDebug()
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            if($this->app_debug == 'true'){
                file_put_contents($path, str_replace('APP_DEBUG=true', 'APP_DEBUG=false', file_get_contents($path)));
            }
            else{
                file_put_contents($path, str_replace('APP_DEBUG=false', 'APP_DEBUG=true', file_get_contents($path)));
            }
        }
        
        $this->dispatchBrowserEvent('success', ['message'=>'Setting updated successfully']);
    }

    public function render()
    {
        $social = SettingFeatureActivation::find(1);
        $this->google_login = $social->google_login;
        $this->facebook_login = $social->facebook_login;
        $this->twitter_login = $social->twitter_login;
        $this->app_debug = env('APP_DEBUG');

        return view('livewire.admin.setting.features-activation-component')->layout('livewire.admin.layouts.base');
    }
}
