<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand; // se importa el modelo
use App\Models\Product; // se importa el modelo
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * El controlador es el encargado de recibir las peticiones del usuario
     * y de enviar las respuestas al usuario
     * Se crea un controlador con el siguiente comando
     * php artisan make:controller ProductController --resource (permite crear los métodos básicos de un controlador)
     * este comando creara un archivo en la carpeta app/Http/Controllers/ con el nombre del controlador
     * en este caso el archivo se llama ProductController.php
     * en este archivo se crea el controlador con los métodos que se desean
     * estos son algunos ejemplos básicos del uso de los controladores
     * index es para mostrar todos los productos
     * create es para mostrar el formulario para crear un producto
     * store es para guardar un producto
     * show es para mostrar un producto
     * edit es para mostrar el formulario para editar un producto
     * update es para actualizar un producto
     * destroy es para eliminar un producto
     * claro que los controladores tienen muchos mas usos
     */

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all(); // se obtienen todos los productos
        return view('products.index', compact('products')); // se envian los productos a la vista
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $brands = Brand::all(); // se obtienen todas las marcas
        return view('products.create', compact('brands')); // se muestra el formulario para crear un producto
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([ // Valida los campos
            'name' => 'required',
            'description' => 'required',
            'brand_id' => 'required'
        ]);

        Product::create([ // Crea el Producto
            'name' => $request->name, // Guarda el Nombre
            'description' => $request->description, // Guarda la Descripción
            'brand_id' => $request->brand_id // Guarda la Marca
        ]);

        return redirect()->route('products.index')->with('success', 'Producto Creado'); // Retorna a la vista de los Productos
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::find($id); // se obtiene el producto con el id que se envia
        $brand = $products->brand; // se obtienen todas las marcas
        return view('products.show', compact('products', 'brand')); // se envia el producto y la marca a la vista
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id); // se obtiene el producto con el id que se envia
        return view('products.edit', compact('product')); // se envia el producto a la vista
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id); // Obtiene el Producto

        $request->validate([ // Valida los campos
            'name' => 'required',
            'description' => 'required',
        ]);

        $product->update($request->all()); // Actualiza el Producto

        return redirect()->route('products.index')->with('message', 'Producto Actualizado'); // Retorna a la vista de los Productos
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id); // Obtiene el Producto
        $product->delete(); // Elimina el Producto
        return redirect()->route('products.index')->with('alert', 'Producto Eliminado'); // Retorna a la vista de los Productos
    }
}
