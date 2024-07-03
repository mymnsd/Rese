<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request){
        // $genre = $request->input('genre');
        // $shops = Shop::whereHas('genre', function($query) use ($genre) {
        // $query->where('name', $genre);
        // })->get();

        // $genres = Shop::pluck('genre.name')->unique();
        // $areas = Shop::pluck('area.name')->unique();

        $shops = Shop::with('area','genre')->get();

        

        // リクエストからの検索条件を取得
        $area = $request->input('area');
        $genre = $request->input('genre');
        $keyword = $request->input('keyword');

        $query = Shop::query();


        if($area && $area != 'All area'){
            $query = $query->area($area);
        }

        if ($genre && $genre != 'All genre') {
        $query = $query->genre($genre);
    }

    if ($keyword) {
        $query = $query->keyword($keyword);
    }

    $shops = $query->get();

    $areas = Area::all();
        $genres = Genre::all();


        // 検索条件に基づいてショップをフィルタリング
        // $shops = Shop::query()
        //         ->area($area)
        //         ->genre($genre)
        //         ->keyword($keyword)
        //         ->get();

        // ビューに変数を渡して表示
        return view('index', compact('shops', 'areas', 'genres', ));
    }
    // public function index(){
    //     $shops = Shop::with('area','genre')->get();

    //     return view('index',compact('shops'));
    // }

    public function detail($id){
        $shop = Shop::find($id);
        return view('shop_detail',compact('shop',));
    }

    // public function search(Request $request){
        // $genre = $request->input('genre');
        // $shops = Shop::whereHas('genre', function($query) use ($genre) {
        // $query->where('name', $genre);
        // })->get();

        // $genres = Shop::pluck('genre.name')->unique();
        // $areas = Shop::pluck('area.name')->unique();
        // $areas = Area::all();
        // $genres = Genre::all();

        // リクエストからの検索条件を取得
        // $area = $request->input('area');
        // $genre = $request->input('genre');
        // $keyword = $request->input('keyword');

        // 検索条件に基づいてショップをフィルタリング
        // $shops = Shop::area($area)
        //         ->genre($genre)
        //         ->keyword($keyword)
        //         ->get();

        // ビューに変数を渡して表示
    //     return view('index', compact('shops', 'areas', 'genres', 'area', 'genre', 'keyword'));
    // }
}