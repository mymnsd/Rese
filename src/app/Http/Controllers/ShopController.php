<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
  public function index(Request $request){
    $area = $request->input('area');
    $genre = $request->input('genre');
    $keyword = $request->input('keyword');
    $sort = $request->input('sort');


    $query = Shop::query()->with('area', 'genre');

    if ($area && $area != 'All area') {
        $query->area($area);
    }

    if ($genre && $genre != 'All genre') {
        $query->genre($genre);
    }

    if ($keyword) {
        $query->keyword($keyword);
    }

    if ($sort == 'random') {
        $query->inRandomOrder();
    } elseif ($sort == 'rating_asc') {
        $query->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')
              ->selectRaw('shops.*, AVG(reviews.rating) as average_rating')
              ->groupBy('shops.id')
              ->orderBy('average_rating', 'asc')
              ->orderByRaw('COUNT(reviews.id) = 0 DESC'); 
    } elseif ($sort == 'rating_desc') {
        $query->leftJoin('reviews', 'shops.id', '=', 'reviews.shop_id')
              ->selectRaw('shops.*, AVG(reviews.rating) as average_rating')
              ->groupBy('shops.id')
              ->orderBy('average_rating', 'desc')
              ->orderByRaw('COUNT(reviews.id) = 0 DESC'); 
    }

    $shops = $query->get();

    $areas = Area::all();
    $genres = Genre::all();

    return view('index', compact('shops', 'areas', 'genres'));

  }

  public function detail($id){
    $shop = Shop::with('reviews.user')->findOrFail($id);
    
    $reservation = Reservation::where('shop_id', $shop->id)->first(); 

    $firstReview = Review::where('shop_id', $id)
      ->orderBy('created_at', 'asc') 
      ->first();

    $otherReviews = Review::where('shop_id', $id)
        ->whereNotIn('id', function ($query) {
          $query->selectRaw('min(id)')
          ->from('reviews')
          ->groupBy('user_id');
        })
        ->with('user')
        ->get();

        $user = auth()->user();

    return view('shop_detail', compact('shop','reservation','firstReview','otherReviews','user'));
  }

  public function allReviews($id)
  {
    $shop = Shop::findOrFail($id);
  
    $otherReviews = Review::where('shop_id', $id)->where('id', '!=', 1)->with('user')->get();

    return view('reviews.all_reviews', compact('shop', 'otherReviews'));
  }

  public function destroy($shopId)
  {
    $user = auth()->user();

    $shop = Shop::findOrFail($shopId);

    if ($shop->manager_id !== $user->id) {
        return redirect()->route('store_manager.index')->with('error', '削除権限がありません。');
    }

    $shop->delete();

    return redirect()->route('store_manager.index')->with('success', '店舗が削除されました。');

  }
}