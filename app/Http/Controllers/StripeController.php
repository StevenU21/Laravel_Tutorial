<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function pay()
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            // 'payment_method_types' => ['card'], //se puede elegir el metodo de pago
            'line_items' => [[ // informaciòn del producto
                'price_data' => [ //informacion del precio
                    'currency' => 'usd', //moneda
                    'product_data' => [ //informacion del producto
                        'name' => $req->name, //nombre del producto
                    ],
                    'unit_amount' => intval($req->price * 100), //hay que pasar el precio en centavos en un int
                ],
                'quantity' => 1, //cantidad
            ]],
            'mode' => 'payment', //modo de pago
            'success_url' => route('succes'), //url de exito
            'cancel_url' => route('index'), //url de cancelacion
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
