<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;
use Carbon\Carbon;



class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->id())->get();
        return view('reserve.index', compact('reservations'));
    }
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

        return view('done'); 
    }

    // public function showCancelConfirmation($id){
    //     $reservation = Reservation::find($id);

    //     if ($reservation) {
    //         session()->flash('showCancelModal', true);
    //     session()->flash('reservationId', $id);
        // session(['showCancelModal' => true, 'reservationId' => $id]);
        // dd(session()->all()); 
        // すべてのセッションデータをダンプして確認
        // }

        // return redirect()->back();
        // ->with('showCancelModal', true)->with('reservationId', $id);
        // ->with([
        // 'showCancelModal' => true,
        // 'reservationId' => $id
        // ]);

        public function confirmCancelPage($id)
    {
        $reservation = Reservation::find($id);
        return view('reserve.confirm_cancel', compact('reservation'));

        $reservation = Reservation::find($id);
        return view('reserve.confirm_cancel', compact('reservation'));
    }

    public function confirmCancel(Request $request, $id)
    {
        $reservation = Reservation::find($id)->delete();
        // $reservation->delete();
        
        return redirect('/mypage')->with('message', '予約をキャンセルしました。');
    }

    // public function destroy($id)
    // {
    //     $reservation = Reservation::find($id)->delete();
        
        // 予約をキャンセル（ここでは単に削除とします）
        // $reservation->delete();
        
    //     return redirect()->route('reserve.index')->with('message', '予約をキャンセルしました。');
    // }

    
    // public function delete(Request $request,$id){
    //     $reservation = Reservation::find($id)->delete();
    //     // $reservation = delete();

    //     return redirect()->back()->with('message','予約をキャンセルしました');
    // }
}


    

