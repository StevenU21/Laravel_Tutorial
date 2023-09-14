# Tutorial de Laravel-Stripe

En esta rama se explica cómo hacer una pequeña integración de la pasarela de pagos Stripe con Laravel de una forma sencilla.

## Pre Requisitos

Para este tutorial es necesario tener una cuenta en Stripe (https://stripe.com) y tener las claves de API que se encuentran en Dashboard -> Desarrolladores -> Claves de API. Hay que usar las claves de prueba a la hora de desarrollar para evitar problemas futuros.

Es necesario tener un proyecto de Laravel con la librería stripe/stripe-php, que es la que nos permite comunicarnos con la API con clases de PHP.

## Cómo funciona la API

La API de Stripe es bastante extensa, pero en este tutorial veremos la forma más sencilla de realizar transacciones, utilizando una sesión de pago que funciona de manera similar a la autenticación de Google.

## Variables necesarias

En el archivo .env definimos dos nuevas variables: STRIPE_SK= y STRIPE_PK=. En STRIPE_SK ponemos la clave secreta y en STRIPE_PK ponemos la clave publicable.

También necesitaremos crear un archivo llamado stripe.php en la carpeta config para poder acceder a las variables. Le ponemos el siguiente contenido:

    <?php

    return [
        'sk' => env('STRIPE_SK'),
        'pk' => env('STRIPE_PK'),
    ];

## Creando la sesión de pago

Para crear una sesión de pago con Stripe, primero tenemos que configurar la clave de API de la siguiente forma:

    \Stripe\Stripe::setApiKey(config('stripe.sk')); //'stripe.sk' es el archivo creado en config

Ahora simplemente creamos el objeto de la sesión:

    $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'], //método de pago
            'line_items' => [[ //información de la transacción
                'price_data' => [ //información del precio
                    'currency' => 'usd', // tipo de moneda
                    'product_data' => [ // información del producto
                        'name' => 'platanos', //nombre del producto
                    ],
                    'unit_amount' => intval(2.99 * 100), //precio del producto, es necesario que sea la cantidad de centavos en un entero
                ],
                'quantity' => 3, //cantidad del producto a comprar
            ]],
            'mode' => 'payment', //tipo de transacción
            'success_url' => route('succes'), //URL a la que redireccionará si el pago es correcto
            'cancel_url' => route('cancel'), //URL a la que redireccionará si el pago falla
        ]);

    return redirect()->away($session->url)
        ->with('stripe_id', $session->id)
        ->with('amount', $req->amount)
        ->with('product_id', $req->product_id)
        ->with('price', $product->price); 
        // esperamos a que Stripe termine para redirecionar y enviar los datos a los metodos
    
Este objeto requiere un array con toda la información para hacer la transacción. Una vez hecho eso, el pago ya está terminado, pero es necesario crear las URLs de cancelación y éxito para que todo funcione correctamente. Además, esto nos permite guardar la información de la transacción.

## Creando las URLs de respuesta

Creamos el metodo para el cancel con su ruta, este metodo solamente redireccionara hacia atras con un mensaje de error.

    public function cancel()
    {
        return redirect()->back()->with('status', 'Pago cancelado');
    }

    //ruta
    Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel')->middleware('auth');

En el metodo success lo vamos a utilizar para guardad la informaciòn de la transaciòn y redirecionar hacia atras.

    public function succes()
    {
        Transaction::create([
            'stripe_id' => session('stripe_id'),
            'amount' => session('amount'),
            'price' => session('price'),
            'product_id' => session('product_id'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('status', 'Pago realizado con exito');
    }

    //ruta
    Route::get('/succes', [StripeController::class, 'succes'])->name('succes')->middleware('auth');

## Fin
