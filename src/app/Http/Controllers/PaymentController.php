<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Exception;
use App\Models\Shop;


class PaymentController extends Controller
{

    public function create($shopId)
    { 
        $shop = Shop::find($shopId);
        return view('payment.create', compact('shop'));
    }

    /**
     * 決済実行
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shop_id' => 'required|exists:stores,id', // 店舗IDのバリデーション
            'stripeToken' => 'required', // Stripeトークンのバリデーション
        ]);

        // 店舗情報を取得
        $shop = Shop::findOrFail($request->store_id);

        // 店舗の料金を取得
        $amount = $shop->price * 100; 

        Stripe::setApiKey(config('stripe.stripe_secret_key'));

        try {
            // $charge = \Stripe\Charge::create([
            // 'amount' => 1000,
            // 'currency' => 'jpy',
            // 'source' => 'tok_visa',
            // 'description' => 'Test charge',
            // ]);
            // $amount = $request->input('amount');

             // フォームから送信された金額を取得
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'jpy',
                'source' => $request->stripeToken, // 実際のトークンを使用
                // 'description' => $store->name . ' の支払い',
                'description' => 'Charge for ' . $shop->name,
            ]);
        //     echo 'Charge created successfully!';
        // } catch (\Stripe\Exception\ApiErrorException $e) {
        //     echo 'Error: ' . $e->getMessage();
        // }
         return redirect()->route('payment.success')->with('status', '決済が完了しました！');
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return back()->with('flash_alert', '決済に失敗しました！('. $e->getMessage() . ')');
        }
    }
}

    

