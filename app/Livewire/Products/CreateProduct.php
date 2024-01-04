<?php

namespace App\Livewire\Products;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;

class CreateProduct extends Component
{
    public $name;
    public $description;
    public $brand_id;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'brand_id' => 'required|exists:brands,id',
    ];

    public function save()
    {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'brand_id' => $this->brand_id,
        ]);

        $this->reset();
        $this->dispatch('success');
    }

    public function render()
    {
        $brands = Brand::all(); // Obtén todas las marcas
        return view('livewire.products.create-product', compact('brands'));
    }
}
