<?php

namespace App\Http\Livewire\Customer;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationComponent extends Component
{
    use WithPagination;
    
    public function render()
    {
        $notifications = DB::table('notifications')
            ->where('user_id', user()->id)
            ->where('user_type', 'customer')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.customer.notification-component', compact('notifications'))->layout('livewire.layouts.base');
    }


    public function markAllRead()
    {
        DB::table('notifications')
            ->where('user_id', user()->id)
            ->where('user_type', 'customer')
            ->update(['seen' => 1]);

        return redirect()->back();
    }
}
