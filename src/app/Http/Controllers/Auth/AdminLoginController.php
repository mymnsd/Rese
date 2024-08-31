<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class AdminLoginController extends Controller
{
    public function showLoginForm(){
        return view('admin.login');
    }

    public function login(LoginRequest $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard'); 
        } else {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors([
                'email' => '権限がありません。',
            ]);
        }
    }

    return back()->withErrors([
        'email' => '認証情報が無効です。',
    ])->withInput($request->only('email'));
}
    
}
