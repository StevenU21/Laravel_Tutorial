<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StripeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route('home');
    }
    else{
        return view('auth.login');
    }
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/pay', [StripeController::class, 'pay'])->name('pay')->middleware('auth');
Route::get('/succes', [StripeController::class, 'succes'])->name('succes')->middleware('auth');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel')->middleware('auth');
