<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        return view('products.create'); // se muestra el formulario para crear un producto
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::find($id); // se obtiene el producto con el id que se envia
        return view('products.show', compact('products')); // se envia el producto a la vista
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::find($id); // se obtiene el producto con el id que se envia
        return view('products.edit', compact('products')); // se envia el producto a la vista
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
