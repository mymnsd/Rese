<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Shop;

class FavoriteController extends Controller
{
    public function create(Request $request){
        $user = auth()->user();
        $userId = Auth::id();
        $shopId = $request->input('shop_id');

        // $favorite =Favorite::where('user_id',$userId)->where('shop_id',$shopId)->first();

        $favorite = $user->favorites()->where('shop_id', $shopId)->first();
    // if ($favorite) {
        // お気に入り解除
        // $favorite->delete();
    // } else {
        // お気に入り登録
    //     $user->favorites()->create(['shop_id' => $shopId]);
    // }
            if(!$favorite){
                Favorite::create([
                'user_id' => $userId,
                'shop_id' => $shopId
                ]);
            }

        return redirect()->back();
    }

    public function delete(Request $request){
        $user = auth()->user();
        $userId = Auth::id();
        $shopId = $request->input('shop_id');

        // $favorite =Favorite::where('user_id',$userId)->where('shop_id',$shopId)->first();

        $favorite = $user->favorites()->where('shop_id', $shopId)->first();

        if($favorite){
            $favorite->delete();
        }
        return redirect()->back();
    }
}
