<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(RegisterRequest $request){
        $user = $request->only(['name', 'email', 'password']);
        $user['password'] = Hash::make($user['password']);
        $newUser = User::create($user);

        Auth::login($newUser);

        $newUser->sendEmailVerificationNotification();

        return view('auth.verify-email');
    }
}
