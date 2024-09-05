<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function create(Reservation $reservation)
    {
    if (!$reservation->canReview()) {
        return redirect()->route('shops.detail', ['shop_id' => $reservation->shop->id])
            ->with('error', '口コミを投稿できるのは来店後のみです。');
    }

    $existingReview = Review::where('user_id', auth()->id())
        ->where('shop_id', $reservation->shop->id)
        ->first();

    if ($existingReview) {
        return redirect()->route('reviews.edit', $existingReview->id)
            ->with('error', 'この店舗にはすでに口コミを投稿しています。口コミは編集してください。');
    }

    $shop = $reservation->shop;


    return view('reviews.create', compact('reservation', 'shop'));
    }

    public function store(ReviewRequest $request,Reservation $reservation)
    {
    
    $validated = $request->validated();

    $existingReview = Review::where('user_id', auth()->id())
            ->where('shop_id', $reservation->shop->id)
            ->first();

    if ($existingReview) {
            return redirect()->route('mypage')->with('error', 'この店舗にはすでに口コミを投稿しています。口コミは編集してください。');
        }

    if (!$reservation->canReview()) {
            return redirect()->route('mypage')->with('error', '口コミを投稿できるのは来店後のみです。');
        }

    Review::create([
            'reservation_id' => $reservation->id,
            'user_id' => auth()->id(),
            'shop_id' => $reservation->shop->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'image_path' => $request->file('image') ? $request->file('image')->store('reviews', 'public') : null, 
        ]);

    return redirect()->route('reviews.thanks')->with('success', '口コミが保存されました');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id != auth()->id()) {
            return redirect()->route('mypage')->with('error', 'この口コミを編集する権限がありません。');
        }

        $shop = $review->reservation->shop;

        return view('reviews.edit', compact('review', 'shop'));
    }

    public function update(ReviewRequest $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validated();

    if ($review->user_id != auth()->id()) {
        return redirect()->route('mypage')->with('error', 'この口コミを編集する権限がありません。');
    }

    if ($request->hasFile('image')) {
        if ($review->image_path) {
            Storage::disk('public')->delete($review->image_path);
        }

        $imagePath = $request->file('image')->store('reviews', 'public');
    } else {
        $imagePath = $review->image_path;
    }

    $review->update([
        'rating' => $request->rating,
        'comment' => $request->comment,
        'image_path' => $imagePath,
    ]);

    return redirect()->route('reviews.thanks')->with('success', '口コミが更新されました');
    }

    public function thanksReview()
    {
        return view('reviews.thanks_review');
    }

    public function destroy($id)
{
    $review = Review::findOrFail($id);

    if ($review->user_id != auth()->id()) {
        return redirect()->route('mypage')->with('error', 'この口コミを削除する権限がありません。');
    }

    $shopId = $review->shop_id;

    $review->delete();

    return redirect()->route('shops.detail', ['shop_id' => $shopId])->with('success', '口コミが削除されました。');
}

public function removeImage(Review $review)
{
    if ($review->image_path) {
        Storage::disk('public')->delete($review->image_path);
        $review->image_path = null;
        $review->save();
    }

    return redirect()->back()->with('success', '画像が削除されました。');
}

}
