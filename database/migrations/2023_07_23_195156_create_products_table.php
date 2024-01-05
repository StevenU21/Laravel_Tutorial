<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // este metodo es para crear la tabla
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id'); // id
            $table->string('name', 60); // atributo name con un limite de 60 caracteres
            $table->string('image_original');
            $table->string('image_name');
            $table->text('description'); // detalles o descripción del producto
            $table->timestamps(); // fecha de creación y actualización
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void // este metodo es para eliminar la tabla
    {
        Schema::dropIfExists('products');
    }
};
