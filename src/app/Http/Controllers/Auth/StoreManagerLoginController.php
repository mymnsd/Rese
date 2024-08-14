<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;


class StoreManagerLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('store_manager.login');
    }

    public function login(LoginRequest $request)
    {
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('store_manager')->attempt($credentials, $request->filled('remember'))) {
            if (Auth::guard('store_manager')->user()->role === 'store_manager') {
                return redirect()->route('store_manager.index');
            } else {
                Auth::guard('store_manager')->logout();
                return redirect()->route('store_manager.login')->withErrors([
                'email' => '権限がありません。',
                ]);
            }
        }

        return back()->withErrors([
            'email' => '認証情報が無効です。',
        ])->withInput($request->only('email'));

    }
}
