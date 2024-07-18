<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\URL;

class VerificationController extends Controller
{

    // メール認証ページの表示
    public function show()
    {
        return view('auth.verify-email');
    }

    public function verify(Request $request, $id, $hash)
    {
        $user = \App\Models\User::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('thanks')
                ->with('message', 'このメールは認証されています');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('thanks')
            ->with('message', 'メールアドレスが確認されました');

    }

    public function thanks(){
        return view('thanks');
    }


    // メール認証の確認
    // public function verify(EmailVerificationRequest $request)
    // {
    //     $user = $request->user();

    // if ($user->hasVerifiedEmail()) {
    //     return redirect('/')->with('message', 'Email already verified.');
    // }

    // if ($user->markEmailAsVerified()) {
    //     event(new Verified($user));
    // }

    // return redirect('/')->with('message', 'Email verified successfully!');
        // $user = $request->user();

        // if ($user === null) {
        //     return redirect('/login'); // ユーザーが認証されていない場合、ログインページにリダイレクト
        // }

        // if ($user->hasVerifiedEmail()) {
        //     return redirect('/');
        // }

        // if ($user->markEmailAsVerified()) {
        //     event(new Verified($user));
        // }

        // return redirect('/')->with('message', 'Email verified successfully!');
    // }

    // メール認証の再送信
    public function resend(Request $request)
    {
        $user = $request->user();

        if ($user === null) {
            return redirect('/login'); // ユーザーが認証されていない場合、ログインページにリダイレクト
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
    

