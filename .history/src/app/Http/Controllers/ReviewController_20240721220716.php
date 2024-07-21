<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Reservation $reservation)
    {
        // $reservation = Reservation::findOrFail($reservationId);
        // return view('reviews.create', compact('reservation'));
        if (!$reservation->canReview()) {
            return redirect('mypage')->with('error', 'レビューを投稿できるのは来店後のみです。');
        }

        return view('reviews.create', compact('reservation'));
    }

    public function store(Request $request,Reservation $reservation)
    {
        if (!$reservation->canReview()) {
            return redirect('mypage')->with('error', 'レビューを投稿できるのは来店後のみです。');
        }

        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'reservation_id' => $request->reservation_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // return view('reviews.thanks_review')->with('success', '評価が保存されました');
        return redirect()->route('reviews.thanks')->with('success', '評価が保存されました');
    }

    public function thanksReview()
    {
        return view('reviews.thanks_review');
    }
}
