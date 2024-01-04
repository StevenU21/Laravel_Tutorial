<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class EditProducts extends Component
{
    public $product;
    public $name;
    public $description;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->dispatch('message');
    }

    public function render()
    {
        return view('livewire.products.edit-products');
    }
}
