<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user){

        if ($user->role === 'admin') {
            return redirect()->route('admin.create_store_manager');
        }

        if ($user->role === 'store-manager') {
        return redirect()->route('store_manager.index');
    }

        return redirect()->route('home');
    }
}
