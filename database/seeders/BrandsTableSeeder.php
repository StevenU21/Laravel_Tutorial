<?php

namespace Database\Seeders; // Importa el namespace de Seeders

use App\Models\Brand; // Importa el modelo Brand
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds. Crea las marcas de ejemplo
     */
    public function run(): void
    {
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
            //php artisan make:seeder BrandsTableSeeder para crear seeder
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
