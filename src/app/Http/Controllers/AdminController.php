<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreManager;
use App\Models\Shop;
use App\Models\User; 
use App\Models\Review;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\StoreManagerRegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function dashboard()
{
    return view('admin.dashboard');
}

    public function createStoreManager()
    {
        $user = Auth::user();
        $shops = Shop::all();

        return view('admin.create_store_manager', compact('shops','user'));
    }

    public function storeStoreManager(StoreManagerRegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::find($request->user_id);
            if (!$user) {
                return redirect()->back()->withErrors(['user_id' => '指定されたユーザーが見つかりません。']);
            }

        $manager = StoreManager::create([
        'user_id' => $user->id,
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
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

    public function registrationComplete(){

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

    public function indexReviews()
{
    $reviews = Review::all(); 

    return view('admin.index', compact('reviews'));
}

    public function destroyReview(Review $review)
    {
        if ($review->image_path && Storage::disk('public')->exists($review->image_path)) {
            Storage::disk('public')->delete($review->image_path);
        }

        $review->delete();

        return redirect()->route('admin.index')->with('success', '口コミが削除されました');
    }
}
