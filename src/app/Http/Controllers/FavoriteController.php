<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Shop;

class FavoriteController extends Controller
{
  public function create(Request $request){
    $user = Auth::user();
    $userId = Auth::id();
    $shopId = $request->input('shop_id');
    $redirectUrl = $request->input('redirect_url', '/');

    $favorite = $user->favorites()->where('shop_id', $shopId)->first();
      if(!$favorite){
        Favorite::create([
          'user_id' => $userId,
          'shop_id' => $shopId
        ]);
      }

        return redirect($redirectUrl);
  }

  public function delete(Request $request){
    $user = Auth::user();
    $userId = Auth::id();
    $shopId = $request->input('shop_id');
    $redirectUrl = $request->input('redirect_url', 'mypage');

    $favorite = $user->favorites()->where('shop_id', $shopId)->first();
      if ($favorite) {
        $favorite->delete(); 
      }

      return redirect($redirectUrl);
  }
}

