<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = User::first()->id;

        $restaurant = new Restaurant();
        $restaurant->user_id = $userId;

        $restaurant->name = "Il ristorante piu bello d'Italia";
        $restaurant->address = 'Via del mare 103';

        $restaurant->image = 'Ci metteremo un img';
        $restaurant->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore veritatis odio sint accusamus velit impedit quaerat unde cumque a';
        $restaurant->phone = '388888888';
        // $restaurant->type_id = random_int(1, 8);

        $restaurant->save();
    }
}