<?php

namespace App\Http\Livewire\App\Notification;

use Livewire\Component;

class NotificationComponent extends Component
{
    public function render()
    {
        return view('livewire.app.notification.notification-component')->layout('livewire.layouts.base');
    }
}
