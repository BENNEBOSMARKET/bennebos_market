<?php

namespace App\Http\Middleware;

use App\Models\Country;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionStart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        if(is_null(Session::get('delivery_country_id'))){
            $ip = request()->ip();
            $ipdat = @json_decode(file_get_contents(
                "http://www.geoplugin.net/json.gp?ip=" . $ip));
    
            $country_shipping = Country::where("name", "LIKE", "%$ipdat->geoplugin_countryName%")->first();
            if($country_shipping){
                Session::put('delivery_country_id', $country_shipping->id);
                Session::put('delivery_country', $country_shipping->name);
            }
        }
        return $next($request);
    }
}
