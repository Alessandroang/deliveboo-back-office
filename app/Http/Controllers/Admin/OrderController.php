<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showOrders()
    {
        // Recupera tutti gli ordini dal database con i piatti e i rispettivi restaurant_id
        $orders = Order::with('plates')->get();

        // Ora puoi accedere ai restaurant_id dei piatti di ciascun ordine
        foreach ($orders as $order) {
            foreach ($order->plates as $plate) {
                // $restaurantId = $plate->pivot->restaurant_id;
                // Usa $restaurantId come necessario
            }
        }
        // Passa gli ordini alla vista e restituisci la vista
        return view('admin.orders.index', compact('orders'));
    }
}