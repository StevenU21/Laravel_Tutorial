<?php

namespace Database\Seeders;

use App\Models\Brand; // se importa el modelo
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Los seeders son archivos que permiten crear datos de prueba en la base de datos
         * para crear un seeder se usa el siguiente comando
         * php artisan make:seeder BrandsTableSeeder
         * este comando creara un archivo en la carpeta database/seeders/ con el nombre BrandsTableSeeder.php
         * en este archivo se crean los datos de prueba
         */

        $brandNames = [ // Nombres de marcas
            'Google',
            'Apple',
            'Samsung',
            'Huawei',
            'Microsoft',
            'MSI',
            'Asus',
            'Acer',
            'Lenovo',
            // Agrega más nombres de marcas según tus necesidades
            //php artisan db:seed --class=BrandsTableSeeder para ejecutar seeder

            /*
            el seeder sirve para generar datos de prueba en la base de datos
            como en este caso, se generan marcas de ejemplo, ya no vamos a crear
            marcas manualmente, sino que se crean con el seeder
            */
        ];

        foreach ($brandNames as $brandName) { // Crea las marcas
            Brand::create([
                'name' => $brandName // Crea una marca con el nombre
            ]);
        }
    }
}
