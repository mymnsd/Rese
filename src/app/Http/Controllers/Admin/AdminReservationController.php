<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::whereHas('shop', function($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return view('admin.reservation', compact('reservations'));
    }
}
