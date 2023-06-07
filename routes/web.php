<?php

use App\Http\Controllers\ProductController;
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

//Rutas para los Productos
Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // Ruta para Mostrar los Productos
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // Ruta para Crear los Productos
Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Ruta para Guardar los Productos
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit'); // Ruta para Editar los Productos
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // Ruta para Actualizar los Productos
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show'); // Ruta para Mostrar los Productos
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Ruta para Eliminar los Productos
