<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'brand_id']; // Campos que se pueden Llenar

    /**
     * en laravel el modelo para una tabla se crea con el siguiente comando
     * php artisan make:model Product
     * este comando creara un archivo en la carpeta app/Models/ con el nombre del modelo
     * en este caso el archivo se llama Product.php
     * en este archivo se crea el modelo con los atributos que se desean
     * el modelo sirve para hacer consultas a la base de datos
     * y para hacer relaciones entre tablas
     * tambien para hacer validaciones de los datos que se van a guardar en la base de datos
     * estos son algunos ejemplos básicos del uso de los modelos
     */

    // Relacion uno a muchos
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
