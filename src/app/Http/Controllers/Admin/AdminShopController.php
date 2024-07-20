<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;

class AdminShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::where('user_id', auth()->id())->get();
        return view('admin.shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::all();
        $genres = Genre::all();
        return view('admin.shops.create', compact('areas', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'genre_id' => 'required|exists:genres,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('public/shops', $imageName);

        $shop = new Shop();
        $shop->user_id = auth()->id();
        $shop->name = $request->name;
        $shop->area_id = $request->area_id;
        $shop->genre_id = $request->genre_id;
        $shop->image_url = 'storage/shops/' . $imageName;
        $shop->save();

        return redirect()->route('shops.index')->with('success', '店舗が追加されました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Shop::where('user_id', auth()->id())->findOrFail($id);
        $areas = Area::all();
        $genres = Genre::all();
        return view('admin.shops.edit', compact('shop', 'areas', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shop = Shop::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'genre_id' => 'required|exists:genres,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/shops', $imageName);
            $shop->image_url = 'storage/shops/' . $imageName;
        }

        $shop->name = $request->name;
        $shop->area_id = $request->area_id;
        $shop->genre_id = $request->genre_id;
        $shop->save();

        return redirect()->route('shops.index')->with('success', '店舗が更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::where('user_id', auth()->id())->findOrFail($id);
        $shop->delete();

        return redirect()->route('shops.index')->with('success', '店舗が削除されました。');
    }
}
