<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreManager;
use App\Models\Shop;
use App\Models\Reservation;

class StoreManagerController extends Controller
{
    public function index()
    {
        $storeManager = auth()->user(); // 現在ログインしている店舗代表者
        $shop = $storeManager->shop;

        // 店舗情報を表示
        return view('store_manager.index', compact('shop'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $storeManager = auth()->user();
        $shop = $storeManager->shop;

        $shop->update($request->only('name', 'description'));

        return redirect()->route('store_manager.index')->with('success', '店舗情報が更新されました。');
    }

    public function reservations()
    {
        $storeManager = auth()->user();
        $shop = $storeManager->shop;

        // 店舗の予約情報を表示
        $reservations = Reservation::where('shop_id', $shop->id)->get();

        return view('store_manager.reservations', compact('reservations'));
    }
}
