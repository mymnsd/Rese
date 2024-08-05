<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role)
    {
        // if (!Auth::check() || Auth::user()->role !== $role) {
            if (!Auth::check()) {
            return redirect()->route('store_manager.login')->withErrors([
            'email' => 'ログインが必要です。',
        ]);

        $user = Auth::user();

        if ($user->role !== $role) {
        // ロールが一致しない場合のリダイレクト
        if ($role === 'admin') {
            return redirect()->route('admin.login')->withErrors([
                'email' => '管理者権限が必要です。',
            ]);
        }

        if ($role === 'store_manager') {
            return redirect()->route('store_manager.login')->withErrors([
                'email' => '店舗代表者権限が必要です。',
            ]);
        }

        return redirect()->route('home')->withErrors([
            'error' => '予期しないエラーが発生しました。',
        ]);
    }

            // ロールが管理者の場合の処理
            // if ($role === 'admin') {
            //     return redirect()->route('admin.login')->withErrors([
            //         'email' => '権限がありません。',
            //     ]);
            // }

            // ロールが店舗代表者の場合の処理
            // if ($role === 'store_manager') {
            //     return redirect()->route('store_manager.login')->withErrors([
            //         'email' => '権限がありません。',
            //     ]);
            // }

            // return redirect()->route('home')->withErrors([
            //     'error' => '予期しないエラーが発生しました。',
            // ]);

        }
        return $next($request);
    }
}

