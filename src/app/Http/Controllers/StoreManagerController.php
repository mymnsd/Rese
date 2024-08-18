<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StoreManager;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreManagerController extends Controller
{
    public function index()
    {
        $storeManagerEmail = auth()->user()->email;
        $storeManagerId = auth()->user()->id;

        $storeManager = StoreManager::find($storeManagerId);
        $shops = $storeManager->shops;

        $managedShops = Shop::join('store_managers', 'shops.manager_id', '=', 'store_managers.id')
            ->where('store_managers.email', $storeManagerEmail)
            ->select('shops.*', 'store_managers.name as manager_name')
            ->get();

        $createdShops = Shop::where('manager_id', $storeManagerId)
            ->select('shops.*')
            ->get();

        $allShops = $managedShops->merge($createdShops)->unique('id');

        return view('store_manager.index', compact('allShops', 'storeManager'));

    }
    

    public function create(){
        $areas = Area::all();
        $genres = Genre::all();

        return view('store_manager.create', compact('areas', 'genres'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'area_id' => 'required|integer',
            'genre_id' => 'required|integer',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'price' => 'nullable|numeric|min:0',
        ]);

        $shop = new Shop($validatedData);
        $shop->manager_id = auth()->id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $shop->image_url = Storage::url($imagePath); 
        }

            $shop->price = $validatedData['price'] ?? 0;
            $shop->save();

        return redirect()->route('store_manager.index')->with('success', '新店舗が追加されました。');
    }

    public function edit($shopId)
    {
        $storeManager = auth()->user();
        $shop = $storeManager->shop;
        $shop = Shop::with(['area', 'genre'])->findOrFail($shopId);

        return view('store_manager.edit', compact('shop'));
    }

    public function update(Request $request,$shopId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|integer|min:0',
        ]);

        $shop = Shop::findOrFail($shopId);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
        
            if ($shop->image_url) {
                $existingImagePath = str_replace('/storage/', 'public/', $shop->image_url);
                Storage::delete($existingImagePath);
            }

            $imagePath = $request->file('image')->store('public/images');
            $shop->image_url = Storage::url($imagePath);
        }

        $shop->update($request->only('name', 'description', 'price','image_url'));
    
        return redirect()->route('store_manager.index')->with('success', '店舗情報が更新されました。');
    }

    public function reservations()
    {
        $storeManager = auth()->guard('store_manager')->user();

        $shop = Shop::where('manager_id', $storeManager->id)->first();

        if (!$shop) {
            return redirect()->route('store_manager.index')->withErrors('店舗が見つかりません。');
        }

        $reservations = Reservation::whereIn('shop_id', $storeManager->shops->pluck('id'))->get();

        if ($reservations->isEmpty()) {
            return redirect()->route('store_manager.index')->with('info', '予約がありません。');
        }

        return view('store_manager.reservations', compact('reservations'));
    }

    public function destroy(Request $request)
    {
        Auth::guard('store_manager')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('store_manager.login')->with('status', 'ログアウトしました。');
    }
}

