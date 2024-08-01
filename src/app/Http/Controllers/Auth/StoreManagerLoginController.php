<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StoreManagerLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('store_manager.auth.login');
    }

    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // ログイン試行
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // 認証に成功した場合
            if (Auth::user()->role === 'store_manager') {
                return redirect()->route('store_manager.index');
            } else {
                Auth::logout();
                return redirect()->route('store-manager.login')->withErrors([
                    'email' => '認証情報が無効です。'
                ]);
            }
            // 認証に失敗した場合
            return back()->withErrors([
                'email' => '認証情報が無効です。'
            ])->withInput($request->only('email'));
    }
        }
}
