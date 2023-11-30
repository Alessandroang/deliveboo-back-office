<?php

namespace Database\Seeders;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Plate;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderPlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $orders = Order::all();
        $plates = Plate::all()
            ->pluck('id')
            ->toArray();

        foreach ($orders as $order) {
            $order->plates()->attach($faker->randomElements($plates, random_int(1, 3)));
        }
    }
}
