<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;
use Carbon\Carbon;


class UserController extends Controller
{
    public function mypage(Request $request){
        $reservations = Reservation::where('user_id',Auth::id())->get();

    return view('mypage', compact('reservations'));
    }
}
