<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;


class ReservationController extends Controller
{
    public function create(request $request){
        $request->validate([
        'shop_id' => 'required',
        'date' => 'required|date',
        'time' => 'required',
        'guest_count' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        $startAt = $request->date . ' ' . $request->time . ':00';
        
        $reservation = new Reservation();
        $reservation->shop_id = $request->shop_id;
        $reservation->guest_count = $request->guest_count;
        $reservation->start_at = $startAt;
        $reservation->user_id = $user->id;
        $reservation->save();

        return view('thanks_reservation');
        
    }
}
