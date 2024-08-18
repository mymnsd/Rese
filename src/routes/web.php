<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StoreManagerController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\StoreManagerLoginController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\StoreManagerNotificationController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 一覧表示
Route::get('/',[ShopController::class,'index']);

// 店舗情報
Route::get('/detail/{shop_id}',[ShopController::class,'detail'])->name('shops.detail');

// ユーザー登録
Route::get('/register',[RegisterController::class,'create']);
Route::post('/register',[RegisterController::class,'store']);

// ユーザーログイン
Route::get('/login',[AuthController::class,'create'])->name('login');
Route::post('/login',[AuthController::class,'store']);

// ユーザールート
Route::middleware('auth')->group(function () {
  // メール認証
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['signed','throttle:6,1'])->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])->middleware(['throttle:6,1'])->name('verification.resend');
    Route::get('/email/verification-sent',[VerificationController::class,'verificationsent'])->name('verification.sent');
    Route::get('/thanks',[VerificationController::class,'thanks'])->name('thanks');

  // レビュー
    Route::get('/reservations/{reservation}/review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reservations/{reservation}/review', [ReviewController::class, 'store'])->name  ('reviews.store');
    Route::get('/reviews/thanks', [ReviewController::class, 'thanksReview'])->name('reviews.thanks');
    
  // ログアウト
    Route::post('/logout', [AuthController::class, 'destroy']);

    // 予約一覧取得
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

  // 予約登録、キャンセル、変更
    Route::post('/reserve',[ReservationController::class,'create']);
    Route::post('/reserve/confirm-cancel-page/{id}',[ReservationController::class,'confirmCancelPage'])->name('reserve.confirmCancelPage');
    Route::post('/reserve/confirm-cancel/{id}', [ReservationController::class,'confirmCancel']) ->name('reserve.confirmCancel');
    Route::get('/reserve/{id}/edit',[ReservationController::class,'edit'])->name('reserve.edit_reserve');
    Route::put('/reserve/{id}',[ReservationController::class,'update'])->name('reserve.update');


  // マイページ
    Route::get('/mypage',[UserController::class,'mypage']);

  // お気に入り登録、解除
    Route::post('/favorite',[FavoriteController::class,'create'])->name('favorite.create');
    Route::post('/favorite/delete',[FavoriteController::class,'delete'])->name('favorite.delete');

  //決済ルート 
    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('/create/{shopId}', [PaymentController::class, 'create'])->name('create');
        Route::post('/store', [PaymentController::class, 'store'])->name('store');
        Route::get('/return', [PaymentController::class, 'return'])->name('return');
    });

    // QRコード生成
    Route::get('/reservations/{reservation}/qrcode', [QRCodeController::class, 'generate'])->name('reservations.qrcode');
});

// 管理者登録
Route::get('admin/create_admin', [AdminController::class, 'createAdmin'])->name('admin.create_admin');
Route::post('admin/store_admin', [AdminController::class, 'storeAdmin'])->name('admin.store_admin');

// 管理者登録完了ページ
Route::get('admin/registration_complete', [AdminController::class, 'registrationComplete'])->name('admin.registration_complete');

// 管理者用ログイン
Route::prefix('admin')->group(function () {
  Route::get('login',[AdminLoginController::class,'showLoginForm'])->name('admin.login');
  Route::post('login',[AdminLoginController::class,'login']);
});

// 店舗代表者作成ルート（管理者のみアクセス）
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/create_store_manager', [AdminController::class, 'createStoreManager'])->name('admin.create_store_manager');
    Route::post('admin/store_store_manager', [AdminController::class, 'storeStoreManager'])->name('admin.store_store_manager');
    Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// 店舗代表者用ログインページ
Route::get('store_manager/login', [StoreManagerLoginController::class, 'showLoginForm'])->name('store_manager.login');
Route::post('store_manager/login', [StoreManagerLoginController::class, 'login']);

// 店舗代表者ルート
Route::middleware(['auth:store_manager', 'role:store_manager'])->group(function () {
    Route::get('store_manager/index', [StoreManagerController::class, 'index'])->name('store_manager.index');

    // 店舗作成
    Route::get('store_manager/create', [StoreManagerController::class, 'create'])->name('store_manager.create');
    Route::post('store_manager/store', [StoreManagerController::class, 'store'])->name('store_manager.store');

    // 編集、更新
    Route::get('store_manager/edit/{shopId}', [StoreManagerController::class, 'edit'])->name('store_manager.edit');
    Route::put('store_manager/update/{shopId}', [StoreManagerController::class, 'update'])->name('store_manager.update');

    // 予約一覧
    Route::get('store_manager/reservations', [StoreManagerController::class, 'reservations'])->name('store_manager.reservations');

    // ログアウト
    Route::post('store_manager/logout', [StoreManagerController::class, 'destroy'])->name('store_manager.logout');

    // 削除
    Route::delete('/shops/{shop}', [ShopController::class, 'destroy'])->name('shops.destroy');

    // お知らせメール送信
    Route::get('/store_manager/notification', [StoreManagerNotificationController::class, 'create'])->name('store_manager.notification');
    Route::post('/store_manager/notification', [StoreManagerNotificationController::class, 'send'])->name('store_manager.sendNotification');

    //QRコード照合
    Route::get('/qrcode/verify', [QRCodeController::class, 'verify'])->name('qrcode.verify');

    // 予約情報の照合
    Route::get('/reservations/{reservation}/verify', [ReservationController::class, 'verify'])->name('reservations.verify');
});
