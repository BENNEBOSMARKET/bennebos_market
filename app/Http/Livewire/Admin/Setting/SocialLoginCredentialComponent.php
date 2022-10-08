<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\SettingSocialLogin;
use Livewire\Component;

class SocialLoginCredentialComponent extends Component
{
    public $client_id, $client_secret, $redirect_url;
    public $facebook_client_id, $facebook_client_secret, $facebook_redirect_url;
    public $twitter_client_id, $twitter_client_secret, $twitter_redirect_url;

    public function mount()
    {
        $this->client_id = env('GOOGLE_CLIENT_ID');
        $this->client_secret = env('GOOGLE_CLIENT_SECRET');
        $this->redirect_url = env('APP_URL').'/customer/login/google/callback';

        $this->facebook_client_id = env('FACEBOOK_CLIENT_ID');
        $this->facebook_client_secret = env('FACEBOOK_CLIENT_SECRET');
        $this->facebook_redirect_url = env('APP_URL').'/customer/login/facebook/callback';

        $this->twitter_client_id = env('TWITTER_CLIENT_ID');
        $this->twitter_client_secret = env('TWITTER_CLIENT_SECRET');
        $this->twitter_redirect_url = env('APP_URL').'/customer/login/twitter/callback';
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'client_id'=>'required',
            'client_secret'=>'required',
            'facebook_client_id'=>'required',
            'facebook_client_secret'=>'required',
            'twitter_client_id'=>'required',
            'twitter_client_secret'=>'required',
        ]);
    }

    public function storeGoogleSecret()
    {
        $this->validate([
            'client_id'=>'required',
            'client_secret'=>'required',
        ]);

        $this->overWriteEnvFile('GOOGLE_CLIENT_ID', $this->client_id);
        $this->overWriteEnvFile('GOOGLE_CLIENT_SECRET', $this->client_secret);

        $this->dispatchBrowserEvent('success', ['message'=>'Google credientials updated successfully']);
    }

    public function storeFacebookSecret()
    {
        $this->validate([
            'facebook_client_id'=>'required',
            'facebook_client_secret'=>'required',
        ]);

        $this->overWriteEnvFile('FACEBOOK_CLIENT_ID', $this->facebook_client_id);
        $this->overWriteEnvFile('FACEBOOK_CLIENT_SECRET', $this->facebook_client_secret);

        $this->dispatchBrowserEvent('success', ['message'=>'Facebook credientials updated successfully']);
    }

    public function storeTwitterSecret()
    {
        $this->validate([
            'twitter_client_id'=>'required',
            'twitter_client_secret'=>'required',
        ]);

        $this->overWriteEnvFile('TWITTER_CLIENT_ID', $this->twitter_client_id);
        $this->overWriteEnvFile('TWITTER_CLIENT_SECRET', $this->twitter_client_secret);

        $this->dispatchBrowserEvent('success', ['message'=>'Twitter credientials updated successfully']);
    }

    public function overWriteEnvFile($type, $val)
    {
        // if(env('DEMO_MODE') != 'On'){
            $path = base_path('.env');
            if (file_exists($path)) {
                $val = '"'.trim($val).'"';
                if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                    file_put_contents($path, str_replace(
                        $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                    ));
                }
                else{
                    file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
                }
            }
        // }
    }

    public function render()
    {
        return view('livewire.admin.setting.social-login-credential-component')->layout('livewire.admin.layouts.base');
    }
}
