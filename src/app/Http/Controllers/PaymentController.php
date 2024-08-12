<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Exception;
use App\Http\Shop;


class PaymentController extends Controller
{

    public function create()
    {
        return view('payment.create');
    }

    /**
     * 決済実行
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'store_id' => 'required|exists:stores,id', // 店舗IDのバリデーション
            'stripeToken' => 'required', // Stripeトークンのバリデーション
        ]);

        // 店舗情報を取得
        $store = Store::findOrFail($request->store_id);

        // 店舗の料金を取得
        $amount = $store->price * 100; // Stripeの金額はセント単位

        Stripe::setApiKey(config('stripe.stripe_secret_key'));

        try {
            // $charge = \Stripe\Charge::create([
            // 'amount' => 1000,
            // 'currency' => 'jpy',
            // 'source' => 'tok_visa',
            // 'description' => 'Test charge',
            // ]);
            $amount = $request->input('amount'); // フォームから送信された金額を取得
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => 'jpy',
                'source' => $request->stripeToken, // 実際のトークンを使用
                // 'description' => $store->name . ' の支払い',
                'description' => 'Charge for ' . $store->name,
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

    

