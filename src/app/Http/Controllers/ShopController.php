<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Http\Controllers\ShopController;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index(){
        $shops = Shop::all();
        return view('index',compact('shops'));
    }
}
