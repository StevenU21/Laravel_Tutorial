<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProducts extends Component
{
    use WithFileUploads;
    public $product;
    public $name;
    public $description;
    public $file;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
    }

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8048',
    ];

    public function update()
    {
        $this->validate($this->rules);

        $oldImage = $this->product->image_name;
        if ($this->file) {

            if ($oldImage) {
                Storage::disk('public')->delete('images/' . $this->product->image_name);
            }

            $imageName = time() . '.' . $this->file->getClientOriginalExtension();
            $this->file->storeAs('public/images', $imageName);

            $validatedData['image_original'] = $this->file->getClientOriginalName();
            $validatedData['image_name'] = $imageName;
        }

        $this->product->update($validatedData);


        $this->dispatch('message');
    }

    public function render()
    {
        return view('livewire.products.edit-products');
    }
}
