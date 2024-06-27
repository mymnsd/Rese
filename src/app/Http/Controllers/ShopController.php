<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Http\Controllers\ShopController;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index(){
        $shops = Shop::with('area','genre')->get();
        return view('index',compact('shops'));
    }
    public function detail($id){
        $shop = Shop::find($id);
        return view('shop_detail',compact('shop',));
    }
}
