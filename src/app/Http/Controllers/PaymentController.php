<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Exception;


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
        Stripe::setApiKey(config('stripe.stripe_secret_key'));

        try {
            $charge = \Stripe\Charge::create([
            'amount' => 1000,
            'currency' => 'jpy',
            'source' => 'tok_visa',
            'description' => 'Test charge',
            ]);
            echo 'Charge created successfully!';
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

    

