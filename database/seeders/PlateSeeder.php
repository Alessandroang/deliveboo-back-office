<?php

namespace Database\Seeders;

use App\Models\Plate;
use App\Models\Restaurant;
use Faker\Generator as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class PlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $categories = Category::all()->pluck('id')->toArray();
        // $categories[] = null;

        $restaurant = Restaurant::first()->id;

        for ($i = 0; $i < 15; $i++) {
            // $category_id = Arr::random($categories);
            $plate = new Plate;
            // $plate->category_id = $category_id;
            $plate->restaurant_id = Arr::random($restaurant);
            $plate->name = $faker->words(2, true);
            $plate->ingredients = implode(', ', $faker->words(5));
            $plate->description = $faker->paragraph(5, true);
            $plate->image = $faker->imageUrl(300, 200);
            $plate->price = $faker->randomFloat(1, 8, 20);
            $plate->visibility = $faker->numberBetween(0, 1);
            $plate->save();
        }
    }

}