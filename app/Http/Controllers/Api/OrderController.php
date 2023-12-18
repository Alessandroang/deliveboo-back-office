<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {

        // Validazione dei dati ricevuti
        $validatedData = $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'address' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'required|string',
            'total_orders' => 'required|numeric',
        ]);

        // Creazione di un nuovo ordine con i dati validati
        $order = Order::create(
            [
                'name' => $validatedData['name'],
                'lastname' => $validatedData['lastname'],
                'address' => $validatedData['address'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'total_orders' => $validatedData['total_orders'],
            ]
        );

        // Restituzione della risposta in formato JSON
        return response()->json([
            'order' => $order
        ], 201);
    }
}