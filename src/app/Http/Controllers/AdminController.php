<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreManager;
use App\Models\Shop;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function createStoreManager()
    {
        // return view('admin.create_store_manager');

        $shops = Shop::all(); // 店舗のリストを取得

        return view('admin.create_store_manager', compact('shops'));
    }

    public function storeStoreManager(Request $request)
    {
        $validator = Validator::make($request->all(),[
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:store_managers',
            // 'password' => 'required|string|min:8|confirmed',
            // 'shop_id' => 'required|exists:shops,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'shop_id' => 'required|exists:shops,id',
        ]);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }

        // データの挿入
        DB::table('store_managers')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'shop_id' => $request->shop_id,
            'role' => 'store_manager', // 店舗代表者の役割を設定
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // StoreManager::create([
            // 'name' => $request->name,
            // 'email' => $request->email,
            // 'password' => bcrypt($request->password),
            // 'shop_id' => $request->shop_id,

        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'role' => 'store_manager', 
        // ]);

        return redirect()->route('admin.create_store_manager')->with('success', '店舗代表者が登録されました。');
    }

    public function createAdmin()
    {
        return view('admin.create_admin');
    }

    public function storeAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // 管理者として登録
        ]);

        return redirect()->route('admin.registration_complete');
        
    }

    public function comprete(){
        return view('admin.registration_complete');
    }
}
