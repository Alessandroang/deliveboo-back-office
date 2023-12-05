<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Plate;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderPlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Ottieni tutti gli ordini e piatti esistenti
        $orders = Order::all();
        $plates = Plate::all();

        // Per ogni ordine, collega un numero casuale di piatti
        $orders->each(function ($order) use ($plates, $faker) {
            // Scegli un numero casuale di piatti da associare all'ordine (da 1 a 3)
            $numberOfPlates = $faker->numberBetween(1, 3);

            // Prendi un subset casuale di piatti
            $selectedPlates = $plates->random($numberOfPlates);

            // Collega gli ordini ai piatti selezionati
            $selectedPlates->each(function ($plate) use ($order, $faker) {
                // Aggiungi l'associazione nella tabella pivot (order_plate)
                DB::table('order_plate')->insert([
                    'order_id' => $order->id,
                    'plate_id' => $plate->id,
                    'quantity' => $faker->numberBetween(1, 5), // Quantità casuale da 1 a 5
                    // Eventuali altri campi della tabella pivot
                ]);
            });
        });
    }
}