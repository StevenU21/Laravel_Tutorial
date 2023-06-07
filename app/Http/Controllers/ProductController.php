<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('brand')->paginate(15); // Obtiene todos los Productos con sus Marcas

        return view('products.index', compact('products')); // Retorna la vista de los Productos
    }

    public function create() // Retorna la vista para Crear los Productos
    {
        $brands = Brand::all(); // Obtiene todas las Marcas
        return view('products.create', compact('brands')); // Retorna la vista para Crear los Productos
    }

    public function store(Request $request) // Guarda los Productos
    {
        $request->validate([ // Valida los campos
            'name' => 'required',
            'description' => 'required',
            'brand_id' => 'required', // Valida que la Marca sea requerida
        ]);

        Product::create([ // Crea el Producto
            'name' => $request->name, // Guarda el Nombre
            'description' => $request->description, // Guarda la Descripción
            'brand_id' => $request->brand_id, // Guarda la Marca
        ]);

        return redirect()->route('products.index')->with('success', 'Producto Creado'); // Retorna a la vista de los Productos
    }

    public function edit($id) // Retorna la vista para Editar los Productos
    {
        $product = Product::findOrFail($id); // Obtiene el Producto
        $brands = Brand::all(); // Obtiene todas las Marcas

        return view('products.edit', compact('product', 'brands')); // Retorna la vista para Editar los Productos
    }

    public function update(Request $request, $id) // Actualiza los Productos
    {
        $product = Product::findOrFail($id); // Obtiene el Producto

        $request->validate([ // Valida los campos
            'name' => 'required',
            'brand_id' => 'required|exists:brands,id',
            'description' => 'required',
        ]);

        $product->update($request->all()); // Actualiza el Producto

        return redirect()->route('products.index')->with('message', 'Producto Actualizado'); // Retorna a la vista de los Productos
    }

    public function show($id)  // Muestra los Productos
    {
        $product = Product::findOrFail($id); // Obtiene el Producto
        $brand = $product->brand; // Obtiene la Marca del Producto
        return view('products.show', compact('product', 'brand')); // Retorna la vista de los Productos
    }

    public function destroy($id) // Elimina los Productos
    {
        $product = Product::findOrFail($id); // Obtiene el Producto
        $product->delete(); // Elimina el Producto

        return redirect()->route('products.index')->with('alert', 'Producto Eliminado'); // Retorna a la vista de los Productos
    }
}
