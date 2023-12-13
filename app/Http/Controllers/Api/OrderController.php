<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Funzione che permette di ricevere i dati e salvarli nel database
    public function GetOrder(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'total_orders' => 'required|numeric',
            // !QUI CI VANNO I NOSTRI PIATTI
            //'cart' => 'required|array'
        ]);

        $order = Order::create([
            'name' => $request->guest_name,
            'lastname' => $request->guest_surname,
            'address' => $request->guest_address,
            'phone' => $request->guest_phone,
            'email' => $request->guest_mail,
            'total_orders' => $request->totalItem,
        ]);

        // !DA CAPIRE QUNADO ABBIAMO IL CART
        // foreach ($request->cart as $item) {
        //     $order->dishes()->attach($item['id'], ['quantity' => $item['qty']]);
        // }

        return response()->json(['message' => 'Ordine ricevuto con successo', 'order_id' => $order->id], 201);
    }
}