<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // protected $redirectTo = '/admin/shops';

    // public function showLoginForm()
    // {
    //     return view('auth.shop_manager_login');
    // }

    // protected function loggedOut(Request $request)
    // {
    //     return redirect('/login/shop_manager');
    // }

    protected function authenticated(Request $request, $user){

        if ($user->role === 'admin') {
            return redirect()->route('admin.create_store_manager');
        }

    // 他の役割の場合のリダイレクト先
        return redirect()->route('home');
    }
}
