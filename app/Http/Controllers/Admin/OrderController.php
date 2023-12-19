<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth; // Aggiunto per utilizzare la facades Auth
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showOrders()
    {
        // Recupera l'ID del ristorante dell'utente autenticato
        $userRestaurantId = Auth::user()->restaurant->id;

        // Recupera tutti gli ordini dal database con i piatti e i rispettivi restaurant_id
        $orders = Order::with('plates')->get();

        // Passa gli ordini e l'ID del ristorante alla vista
        return view('admin.orders.index', compact('orders', 'userRestaurantId'));
    }
}
