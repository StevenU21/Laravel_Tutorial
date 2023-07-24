<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('brand_id')->unsigned(); // Marca del Producto
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Esta nueva columna para la tabla products se llama brand_id y es de tipo entero sin signo (unsigned)
     * se creo con el siguiente comando de la terminal
     * php artisan make:migration add_brand_id_to_products
     * esto permite que la columna brand_id sea una llave foranea de la tabla brands
     * para migrar esta tabla a la base de datos debes de ejecutar el siguiente comando
     * php artisan migrate:refresh
     * en caso de errores ejecuta el siguiente comando
     * php artisan migrate:rollback
     * o si no ve a tu base de datos y borra las tablas y vuelve a migrar,
     * si revisas products en tu base de datos veras que se creo la columna brand_id
     */

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropColumn('brand_id');
        });
    }
};
