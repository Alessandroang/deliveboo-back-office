<?php

namespace Database\Seeders;
use App\Models\Order;
use App\Models\Restaurant;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurantId = Restaurant::first()->id;

        $order = new Order();
        $order->restaurant_id = $restaurantId;

        $order->name = "Il ristorante piu bello d'Italia";
        $order->lastname = 'Italia';

        $order->address = 'Via del mare 103';
        $order->email = 'ciao@ciao.com';
        $order->phone = '388888888';
        $order->total_orders = '8';
        $order->success = 1;
        $order->date = '2023-10-12 10:30:32';

        $order->save();
    }
}
