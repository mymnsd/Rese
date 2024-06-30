<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;
use Carbon\Carbon;



class ReservationController extends Controller
{
    public function create(request $request){
        $request->validate([
        'shop_id' => 'required|integer',
        'date' => 'required|date_format:Y-m-d',
        'time' => 'required|date_format:H:i',
        'guest_count' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        $startAt = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->time);
        
        $reservation = new Reservation();
        $reservation->shop_id = $request->shop_id;
        $reservation->guest_count = $request->guest_count;
        $reservation->start_at = $startAt;
        $reservation->user_id = $user->id;
        $reservation->save();

        $shop = Shop::find($reservation->shop_id); 

        return view('thanks_reservation');
        
    }
}
