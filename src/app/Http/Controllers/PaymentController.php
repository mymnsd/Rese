<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Charge;
use Exception;
use App\Models\Shop;


class PaymentController extends Controller
{

    public function create(Request $request,$shopId)
    { 
        $shop = Shop::find($shopId);
        $guest_count = $request->input('guest_count',1);
        
        $price = $shop->price * $guest_count;

        return view('payment.create', compact('shop', 'guest_count','price'));
        
    }

    /**
     * 決済実行
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shop_id' => 'required|exists:shops,id', 
            'payment_method_id' => 'required',
            'guest_count' => 'required|integer|min:1'
        ]);

        $shop = Shop::findOrFail($request->shop_id);

        // $guestCount = $request->guest_count;
        $guestCount = intval($request->guest_count); 

        $totalAmount = $shop->price * $guestCount * 100;
        $minimumAmount = 100;
        $totalAmount = max($totalAmount, $minimumAmount);


        Stripe::setApiKey(config('stripe.stripe_secret_key'));

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' =>  $totalAmount, 
                'currency' => 'jpy',
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual', 
                'confirm' => true,
                'description' => 'Charge for ' . $shop->name,
                'return_url' => route('payment.return', ['shop_id' => $shop->id])
            ]);

            if ($paymentIntent->status === 'requires_action') {
            return redirect($paymentIntent->next_action->redirect_to_url->url);
        }
            return redirect()->route('payment.return')->with('status', '決済が完了しました！');
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return back()->with('flash_alert', '決済に失敗しました！('. $e->getMessage() . ')');
            }
    }        

    public function return()
    {
        return view('payment.return'); 
    }
}

    

