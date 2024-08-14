<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreManager;
use App\Models\Shop;
use App\Models\User; 
use App\Http\Requests\AdminRegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function createStoreManager()
    {
        $shops = Shop::all();

        return view('admin.create_store_manager', compact('shops'));
    }

    public function storeStoreManager(AdminRegisterRequest $request)
    {
        DB::table('store_managers')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'shop_id' => $request->shop_id,
            'role' => 'store_manager', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.create_store_manager')->with('success', '店舗代表者が登録されました。');
    }

    public function createAdmin()
    {
        return view('admin.create_admin');
    }

    public function storeAdmin(AdminRegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', 
        ]);

        return redirect()->route('admin.registration_complete');
        
    }

    public function comprete(){
        return view('admin.registration_complete');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $request->session()->flash('message', 'ログアウトしました');

        return redirect()->route('admin.login');
    }
}
