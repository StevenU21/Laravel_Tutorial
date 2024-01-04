<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class LoadProducts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        $this->dispatch('danger');
    }

    public function render()
    {
        $products = Product::with('brand')->latest()->paginate(10);
        return view('livewire.products.load-products', ['products' => $products]);
    }
}
