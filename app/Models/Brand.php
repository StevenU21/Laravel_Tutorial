<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description']; // Campos que se pueden Llenar

    public function products() // Relación de uno a muchos
    {
        return $this->hasMany(Product::class); // Una Marca tiene muchos Productos
    }
}
