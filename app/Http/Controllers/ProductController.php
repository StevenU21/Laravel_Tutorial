<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product; // se importa el modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index'); // se envian los productos a la vista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create'); // se muestra el formulario para crear un producto
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product')); 
    }    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id); // se obtiene el producto con el id que se envia
        return view('products.edit', compact('product')); // se envia el producto a la vista
    }
}
