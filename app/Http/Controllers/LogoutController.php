<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function sellerLogout(Request $request)
    {
        Auth::guard('seller')->logout();
        return redirect()->route('home.index');
    }

    public function customerLogout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->route('home.index');
    }
}
