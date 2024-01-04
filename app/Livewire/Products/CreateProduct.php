<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class CreateProduct extends Component
{
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function save()
    {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->reset();
        $this->dispatch('success');
    }

    public function render()
    {
        return view('livewire.products.create-product');
    }
}
