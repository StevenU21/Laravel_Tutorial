<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ShowProducts extends Component
{
    public $product;

    public function mount($id)
    {
        $this->product = Product::find($id);
    }

    public function render()
    {
        return view('livewire.products.show-products');
    }
}
