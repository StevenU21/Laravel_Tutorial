<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rent>
 */
class RentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'book_id' => function () {
                return \App\Models\Book::factory()->create(['status' => 'available'])->id;
            },
            'rent_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'return_date' => function (array $attributes) {
                // Puedes personalizar la generación de la fecha de devolución según tus necesidades.
                return \Carbon\Carbon::parse($attributes['rent_date'])->addDays($this->faker->numberBetween(7, 30));
            },
        ];
    }
}
