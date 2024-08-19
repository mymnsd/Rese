<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Review; 
use App\Models\Shop;
use Carbon\Carbon;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    public function index(){
        $user = auth()->user();

        $reviews = Review::where('user_id', $user->id)->get();
        // $reservations = Reservation::where('user_id', auth()->id())->with('shop')->get();
        
         // すべての予約を取得
    $reservations = Reservation::where('user_id', $user->id)->get();
        return view('reservations.index', compact('reservations','reviews'));

    }

    public function create(ReservationRequest $request){
        $user = Auth::user();

        $startAt = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->time);

        if ($startAt->isPast()) {
            return redirect()->back()->withErrors(['time' => '過去の時間には予約できません。'])->withInput();
        }
        
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

        $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $datetime);

        if ($startAt->isPast()) {
        return redirect()->back()->withErrors(['time' => '過去の時間には予約できません。'])->withInput();
    }

        $reservation->start_at = $datetime;
        $reservation->guest_count = $request->input('guest_count');
        $reservation->save();

        return view('reserve.edit');
    }

    public function show($reservationId)
{
    $reservation = Reservation::with('shop', 'user')->findOrFail($reservationId);
    return view('reservations.show', compact('reservation'));
}

    public function verify($reservationId)
    {
        $user = Auth::user();

        $reservation = Reservation::with('shop', 'user')->find($reservationId);

        if ($reservation->shop->manager_id !== $user->id) {
            return response()->json(['status' => 'fail', 'message' => 'この予約情報にはアクセスできません。']);
        }

        if ($reservation) {
            return response()->json([
                'status' => 'success',
                'reservation' => [
                    'id' => $reservation->id,
                    'shop_name' => $reservation->shop->name,
                    'user_name' => $reservation->user->name,
                    'guest_count' => $reservation->guest_count,
                    'start_at' => $reservation->start_at,
                ]
            ]);
        } else {
            return response()->json(['status' => 'fail']);
            }
    }
}

