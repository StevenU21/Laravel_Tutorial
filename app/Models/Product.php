<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'image_original', 'image_name']; // Campos que se pueden Llenar

    public function url()
    {
        return (string) 'http://' . Storage::disk('public')->url('images/' . $this->image_name);
    }

}
