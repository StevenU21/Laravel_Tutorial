<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class StripeController extends Controller
{
    public function pay(Request $req)
    {
        $product = Product::find($req->product_id);

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            // 'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => intval($product->price * 100),
                ],
                'quantity' => $req->amount,
            ]],
            'mode' => 'payment',
            'success_url' => route('succes'),
            'cancel_url' => route('cancel'),
        ]);

        return redirect()->away($session->url)
        ->with('stripe_id', $session->id)
        ->with('product_id', $req->product_id);
    }

    public function succes()
    {
        return redirect()->back()->with('status', 'Pago realizado con exito');
    }

    public function cancel()
    {
        return redirect()->back()->with('status', 'Pago cancelado');
    }
}
