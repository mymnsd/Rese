<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Http\Request;

class ShopController extends Controller
{
  public function index(Request $request){
    $shops = Shop::with('area','genre')->get();

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

    return view('index', compact('shops', 'areas', 'genres', ));
  }

  public function detail($id){
    $shop = Shop::find($id);

    return view('shop_detail',compact('shop',));
  }

  

}