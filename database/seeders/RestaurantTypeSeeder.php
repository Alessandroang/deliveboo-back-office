<?php

namespace Database\Seeders;
use App\Models\Type;
use App\Models\Restaurant;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $restaurants = Restaurant::all();
        $types = Type::all()
            ->pluck('id')
            ->toArray();

        foreach ($restaurants as $restaurant) {
            $restaurant->types()->attach($faker->randomElements($types, random_int(1, 3)));
        }
    }
}
