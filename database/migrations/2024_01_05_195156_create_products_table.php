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
            $table->text('description'); // detalles o descripción del producto

            $table->integer('brand_id')->unsigned(); // llave foranea de la tabla brands
            $table->foreign('brand_id')->references('id')->on('brands'); // referencia a la tabla brands
            $table->timestamps(); // fecha de creación y actualización
        });
    }

    /**en laravel para crear una tabla o migración debes de ejecutar el siguiente comando de la terminal
     * php artisan make:migration create_products_table
     * este comando creara un archivo en la carpeta database/migrations/ con el nombre de la migración y la fecha de creación
     * en este caso el archivo se llama 2023_07_23_195156_create_products_table.php
     * en este archivo se crea la tabla con los atributos que se desean
     * para migrar esta tabla a la base de datos debes de ejecutar el siguiente comando
     * php artisan migrate
     * este comando ejecutara todas las migraciones que se encuentren en la carpeta database/migrations/
     * recuerda que antes debiste configurar el archivo .env con los datos de tu base de datos
     * */

    /**
     * Reverse the migrations.
     */
    public function down(): void // este metodo es para eliminar la tabla
    {
        Schema::dropIfExists('products');
    }
};
