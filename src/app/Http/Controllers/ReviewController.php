<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Reservation $reservation)
    {
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
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $shopId = $reservation->shop->id; 

        Review::create([
            'reservation_id' => $reservation->id,
            'user_id' => auth()->id(),
            'shop_id' => $shopId, 
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('reviews.thanks')->with('success', '評価が保存されました');
    }

    public function thanksReview()
    {
        return view('reviews.thanks_review');
    }
}
