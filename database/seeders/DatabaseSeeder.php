<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('brands')->insert([
                'name' => $faker->company,
            ]);
        }

        $brandIds = DB::table('brands')->pluck('id')->toArray();

        for ($i = 1; $i <= 50; $i++) {
            DB::table('products')->insert([
                'name' => $faker->word,
                'description' => $faker->sentence,
                'brand_id' => $faker->randomElement($brandIds),
            ]);
        }
    }
}
