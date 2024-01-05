<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $file;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8048',
    ];

    public function save()
    {
        $this->validate($this->rules);

        $imageName = time() . '.' . $this->file->getClientOriginalExtension();
        $this->file->storeAs('public/images', $imageName);
        //tambien se puede guardar con el Storage Disk de Laravel pero esta opcion es mas sencilla

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'image_original' => $this->file->getClientOriginalName(),
            'image_name' => $imageName,
        ]);

        $this->reset();
        $this->dispatch('success');
    }

    public function render()
    {
        return view('livewire.products.create-product');
    }
}
