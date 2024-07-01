<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(Request $request){
        $user = $request->only(['name','email','password']);
        $user['password'] = Hash::make($user['password']);
        User::create($user);
        return view('thanks');
    }
}
