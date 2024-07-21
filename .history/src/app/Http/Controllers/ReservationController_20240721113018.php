<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;
use Carbon\Carbon;
use App\Http\Requests\ReservationRequest;



class ReservationController extends Controller
{
    public function index(){
        $reservations = Reservation::where('user_id', auth()->id())->get();
        return view('reserve.index', compact('reservations'));
    }

    public function create(ReservationRequest $request){
        $user = Auth::user();

        $startAt = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->time);
        
        $reservation = new Reservation();
        $reservation->shop_id = $request->shop_id;
        $reservation->guest_count = $request->guest_count;
        $reservation->start_at = $startAt;
        $reservation->user_id = $user->id;
        $reservation->save();

        $shop = Shop::find($reservation->shop_id); 

        return view('done'); 
    }

    public function confirmCancelPage($id){
        $reservation = Reservation::find($id);
        return view('reserve.confirm_cancel', compact('reservation'));
    }

    public function confirmCancel(Request $request, $id){
        $reservation = Reservation::find($id)->delete();
        
        return view('reserve.cancel');
    }

    public function edit($id){
        $reservation = Reservation::find($id);
        return view('reserve.edit_reserve', compact('reservation'));
    }

    public function update(Request $request,$id){
        $reservation = Reservation::with('shop')->find($id);
        $date = $request->input('start_at');
        $time = $request->input('time');
        $datetime = $date . ' ' . $time . ':00';

        $reservation->start_at = $datetime;
        $reservation->guest_count = $request->input('guest_count');
        $reservation->save();

        return view('reserve.edit');
    }

    public function verify($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        // 予約確認処理
        if ($reservation) {
            return response()->json([
                'status' => 'success',
                'message' => '予約が確認されました。',
                'reservation' => $reservation,
            ]);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => '予約が見つかりません。',
            ]);
        }
    }

    
}


    

