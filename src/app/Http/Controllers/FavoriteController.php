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


  // test
  // public function create(Request $request)
  //   {
  //       $user = Auth::user();
  //       if (!$user) {
  //           return redirect()->back()->with('error', 'User not authenticated.');
  //       }

  //       $shopId = $request->input('shop_id');
  //       $redirectUrl = $request->input('redirect_url', '/');

  //       if (!$shopId) {
  //           return redirect()->back()->with('error', 'Shop ID is required.');
  //       }

  //       $favorite = $user->favorites()->where('shop_id', $shopId)->first();
  //       if (!$favorite) {
  //           Favorite::create([
  //               'user_id' => $user->id,
  //               'shop_id' => $shopId
  //           ]);
  //       }

  //       return redirect($redirectUrl)->with('success', 'Favorite added successfully.');
  //   }

  //   public function delete(Request $request)
  //   {
  //       $user = Auth::user();
  //       if (!$user) {
  //           return redirect()->back()->with('error', 'User not authenticated.');
  //       }

  //       $shopId = $request->input('shop_id');
  //       $redirectUrl = $request->input('redirect_url', '/');

  //       if (!$shopId) {
  //           return redirect()->back()->with('error', 'Shop ID is required.');
  //       }

  //       $favorite = $user->favorites()->where('shop_id', $shopId)->first();
  //       if ($favorite) {
  //           $favorite->delete();
  //       }

  //       return redirect($redirectUrl)->with('success', 'Favorite removed successfully.');
  //   }

}

