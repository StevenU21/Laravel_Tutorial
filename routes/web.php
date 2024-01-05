<?php

use App\Http\Controllers\ProductController; // Importamos el Controlador de Productos
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

/**
 * Rutas para los Usuarios
 * las rutas se pueden agrupar para que sean mas legibles
 * y se pueden agregar prefijos a las rutas
 * las rutas son las que se encargan de llamar a los controladores
 * y los controladores son los que se encargan de llamar a las vistas
 */

//Rutas para los Productos
Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // Ruta para Mostrar los Productos
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // Ruta para Crear los Productos
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show'); // Ruta para Mostrar un Producto
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit'); // Ruta para Editar un Producto
