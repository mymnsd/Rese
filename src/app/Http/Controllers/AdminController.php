<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\StoreManager;
use App\Models\Shop;
use App\Models\User; 
use App\Models\Area;
use App\Models\Genre;
use App\Models\StoreMnager;
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

    // インポートフォーム表示
    public function showImportForm()
    {
        return view('admin.import_shops');
    }

    // CSVインポート処理
    public function importShops(Request $request)
    {
    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt',
    ]);

    $file = $request->file('csv_file');
    $csvData = file_get_contents($file->getRealPath());
    $rows = array_map('str_getcsv', explode("\n", $csvData));
    $header = array_shift($rows);

    foreach ($rows as $row) {
        if (count($row) == count($header)) {
            $data = array_combine($header, $row);

            // バリデーションを行いながら店舗情報を保存
            $validator = Validator::make($data, [
                '店舗名' => 'required|string|max:50',
                '地域' => 'required|in:東京都,大阪府,福岡県',
                'ジャンル' => 'required|in:寿司,焼肉,イタリアン,居酒屋,ラーメン',
                '店舗概要' => 'required|string|max:400',
                '画像URL' => 'required|url|ends_with:.jpeg,.jpg,.png',
                // '価格' => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                return redirect()->route('admin.import_shops.form')
                    ->withErrors($validator)
                    ->withInput(); // エラーと入力データをリダイレクト
                // バリデーションに失敗したらエラーログを出力
                // \Log::error('バリデーションエラー:', $validator->errors()->toArray());
                // continue;
            }

            // `地域`名から`areas`テーブルのIDを取得
            $area = Area::where('name', $data['地域'])->first();
            if (!$area) {
                \Log::error('地域が見つかりません:', $data);
                continue; // 地域が見つからない場合はスキップ
            }

            // `ジャンル`名から`genres`テーブルのIDを取得
            $genre = Genre::where('name', $data['ジャンル'])->first();
            if (!$genre) {
                \Log::error('ジャンルが見つかりません:', $data);
                continue; // ジャンルが見つからない場合はスキップ
            }

            // `店舗代表者`名から`store_managers`テーブルのIDを取得
            $manager = StoreManager::where('name', $data['店舗代表者'])->first();
            if (!$manager) {
                Log::error('店舗代表者が見つからない', [
                    '店舗名' => $data['店舗名'],
                    '店舗代表者' => $data['店舗代表者'],
                    'CSVデータ' => $data
                    ]);
                // \Log::error('店舗代表者が見つかりません:', $data);
                continue; // 店舗代表者が見つからない場合はスキップ
            }

            // データを保存
            Shop::create([
                'name' => $data['店舗名'],
                'area_id' => $area->id,
                'genre_id' => $genre->id,
                'description' => $data['店舗概要'],
                'image_url' => $data['画像URL'],
                'price' => $data['価格'],
                'manager_id' => $manager->id,
                
            ]);
        }
    }

    return redirect()->route('admin.import_shops.form')->with('success', '店舗情報をインポートしました。');
}
}