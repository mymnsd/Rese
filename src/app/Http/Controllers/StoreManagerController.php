<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StoreManager;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class StoreManagerController extends Controller
{
    public function index()
    {
        $storeManagerId = auth()->user()->id; 
        $shop = DB::table('shops')
            ->join('store_managers', 'shops.id', '=', 'store_managers.shop_id')
            ->where('store_managers.id', $storeManagerId)
            ->select('shops.*', 'store_managers.name as manager_name')
            ->first();

        return view('store_manager.index', compact('shop'));
    }
    

    public function create(){
        return view('store_manager.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'area_id' => 'required|integer',
            'genre_id' => 'required|integer',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        // 新店舗の作成
        $shop = new Shop($validatedData);
        $shop->user_id = auth()->id();
        $shop->save();

        // リダイレクト
        return redirect()->route('store_manager.index')->with('success', '新店舗が追加されました。');
    }

    public function edit()
    {
        $storeManager = auth()->user();
        $shop = $storeManager->shop;

        return view('store_manager.edit', compact('shop'));
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
