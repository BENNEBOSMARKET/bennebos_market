<?php

namespace App\Http\Livewire\Admin\Layouts\Inc;

use App\Models\Country;
use App\Models\Order;
use App\Models\Seller;


use App\Models\Shop;


use App\Models\Ticket;
use App\Models\WebsiteSetting;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $orders=Order::all()->count();
        $countCoordinatesNon=Country::where('latitude',null)->orWhere('longitude',null)->count();
        $ticket=Ticket::all()->count();


        $pendingSellers = Shop::where('verification_status','!=',1)->count();


        return view('livewire.admin.layouts.inc.sidebar', [
            'countCoordinatesNon' => $countCoordinatesNon,
            'orders'=>$orders,
            'ticket'=>$ticket,
            'pendingSellers'=>$pendingSellers,
        ]);
    }
}
