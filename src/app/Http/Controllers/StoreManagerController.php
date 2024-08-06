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
        $storeManagerId = auth()->id();
        // $addedShops = Shop::where('user_id', $storeManagerId)->get();

        $addedShops = Shop::with(['area', 'genre'])
                      ->where('user_id', $storeManagerId)
                      ->get();

        
        // $managedShops = DB::table('shops')
        // ->join('store_managers', 'shops.id', '=', 'store_managers.shop_id')
        // ->where('store_managers.id', $storeManagerId)
        // ->select('shops.*', 'store_managers.name as manager_name')
        // ->get();
        $managedShops = Shop::join('store_managers', 'shops.id', '=', 'store_managers.shop_id')
                        ->where('store_managers.id', $storeManagerId)
                        ->select('shops.*', 'store_managers.name as manager_name')
                        ->with('area', 'genre') // リレーションを含める
                        ->get();

        return view('store_manager.index', compact('addedShops', 'managedShops'));
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
        ]);

        $shop = new Shop($validatedData);
        $shop->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $shop->image_url = Storage::url($imagePath); 
        }
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

        $shop->update($request->only('name', 'description'));
    
        return redirect()->route('store_manager.index')->with('success', '店舗情報が更新されました。');
    }

    public function reservations()
    {
        $storeManager = auth()->user();
        $shop = $storeManager->shop;

        $reservations = Reservation::where('shop_id', $shop->id)->get();

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

