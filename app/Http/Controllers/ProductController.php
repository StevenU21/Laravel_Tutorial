<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product; // se importa el modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
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
        $request->validate([ // Valida los campos
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8048', // Valida que el archivo sea una imagen
        ]);
        // Guarda la imagen en el disco público y obtén su nombre
        $imageName = time() . '.' . $request->file->extension();
        Storage::disk('public')->put('images/' . $imageName, file_get_contents($request->file));

        Product::create([ // Crea el Producto
            'name' => $request->name, // Guarda el Nombre
            'description' => $request->description, // Guarda la Descripción
            'image_original' => $request->file->getClientOriginalName(), // Guarda el nombre original de la imagen
            'image_name' => $imageName, // Guarda el nombre de la imagen
        ]);

        return redirect()->route('products.index')->with('success', 'Producto Creado'); // Retorna a la vista de los Productos
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
            'file' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8048', // Valida que el archivo sea una imagen
        ]);

        $data = $request->only(['name', 'description']); // Obtiene solo los campos 'name' y 'description'

        if ($request->hasFile('file')) {
            // Guarda la imagen en el disco público y obtén su nombre
            $imageName = time() . '.' . $request->file->extension();
            Storage::disk('public')->put('images/' . $imageName, file_get_contents($request->file));

            // Actualiza el nombre de la imagen en la base de datos
            $data['image_original'] = $request->file->getClientOriginalName();
            $data['image_name'] = $imageName;
        }

        $product->update($data); // Actualiza el Producto

        return redirect()->route('products.index')->with('message', 'Producto Actualizado'); // Retorna a la vista de los Productos
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id); // Obtiene el Producto
        $product->delete(); // Elimina el Producto
        //elimina la imagen del disco público
        Storage::disk('public')->delete('images/' . $product->image_name);
        return redirect()->route('products.index')->with('alert', 'Producto Eliminado'); // Retorna a la vista de los Productos
    }
}
