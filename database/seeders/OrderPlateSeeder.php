<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Plate;
use App\Models\OrderPlate;
use Faker\Generator as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderPlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $faker = Faker::create();
        $order_plate = new OrderPlate;
        $orders = Order::all();
        $plates = Plate::all()
            ->pluck('id')
            ->toArray();

        foreach ($orders as $order) {
            $order_plate->quantity = $faker->randomNumber(1, 10);
            $order->plates()->attach($faker->randomElements($plates, random_int(1, 3)));
        }
    }
}