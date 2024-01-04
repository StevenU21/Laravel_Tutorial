<?php

namespace App\Livewire\Products;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;

class EditProducts extends Component
{
    public $product;
    public $name;
    public $description;
    public $brand_id; // Nuevo campo para la relación con la marca

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->brand_id = $product->brand_id;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'brand_id' => 'required|exists:brands,id', // Validar que la marca exista
        ]);

        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'brand_id' => $this->brand_id,
        ]);

        $this->dispatch('message');
    }

    public function render()
    {
        $brands = Brand::all(); // Obtén todas las marcas
        return view('livewire.products.edit-products', compact('brands'));
    }
}
