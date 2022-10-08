<?php

namespace App\Http\Livewire\Admin\Layouts\Inc;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Navbar extends Component
{
    public function optimizeSite()
    {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        $this->dispatchBrowserEvent('success', ['message'=>'Website optimized successfully']);
    }

    public function render()
    {
        $notifications = DB::table('notifications')
            ->where('user_type', 'admin');

        $totalUnread = $notifications->where('seen', 0)->count();

        $notifications = $notifications->get();

        return view('livewire.admin.layouts.inc.navbar', compact('notifications', 'totalUnread'));
    }
}
