<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(LoginRequest $request){

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect('/')->with('modal', 'modal3');
        }
    }

    public function destroy(Request $request){
        Auth::logout(); 
        return redirect('/'); 
    }
}
