<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $imagesPath = public_path('img');
        $images = File::allFiles($imagesPath);

        // Selecciona una imagen aleatoria
        $randomImage = $this->faker->randomElement($images);

        // Crea un nuevo nombre de imagen
        $newImageName = time() . '_' . $this->faker->word . '.jpg'; // O el formato que desees

        // Copia la imagen al disco público en la carpeta de imágenes
        File::copy($randomImage->getPathname(), Storage::disk('public')->path('images/' . $newImageName));

        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text(60),
            'image_original' => $randomImage->getFilename(),
            'image_name' => $newImageName,
        ];
    }
}