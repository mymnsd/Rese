<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function create(request $request){
        $reservation = $request->only(['shop_id','user_id','guest_count','start_at']);
        Reservation::create($reservation);
        return view('thanks_reservation');
    }
}
