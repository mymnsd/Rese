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
             \Log::info('Cannot review: ' . $reservation->id);
            return redirect('mypage')->with('error', 'レビューを投稿できるのは来店後のみです。');
        }

        $existingReview = Review::where('user_id',
        auth()->id())
        ->where('shop_id', $reservation->shop->id)
        ->first();

        if ($existingReview) {
              \Log::info('Existing review found: ' . $existingReview->id);
            return redirect()->route('reviews.edit', $existingReview->id)
            ->with('error', 'この店舗にはすでにレビューを投稿しています。レビューは編集してください。');
        }
 \Log::info('Creating new review for reservation: ' . $reservation->id);
        return view('reviews.create', compact('reservation'));
    }

    public function store(Request $request,Reservation $reservation)
    {
        $existingReview = Review::where('user_id', auth()->id())
        ->where('shop_id', $reservation->shop->id)
        ->first();

        if ($existingReview) {
        return redirect()->route('mypage')->with('error', 'この店舗にはすでにレビューを投稿しています。レビューは編集してください。');
    }

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

    public function edit($id)
{
    $review = Review::findOrFail($id);

    if ($review->user_id != auth()->id()) {
        return redirect()->route('mypage')->with('error', 'このレビューを編集する権限がありません。');
    }

    return view('reviews.edit', compact('review'));
}

public function update(Request $request, $id)
{
    $review = Review::findOrFail($id);

    // 認証済みユーザーがレビューの投稿者であることを確認
    if ($review->user_id != auth()->id()) {
        return redirect()->route('mypage')->with('error', 'このレビューを編集する権限がありません。');
    }

    // バリデーション
    $request->validate([
        'rating' => 'required|integer|between:1,5',
        'comment' => 'nullable|string|max:1000',
    ]);

    // レビューを更新
    $review->update([
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return redirect()->route('reviews.thanks')->with('success', 'レビューが更新されました');
}

    public function thanksReview()
    {
        return view('reviews.thanks_review');
    }
}
