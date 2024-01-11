<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth; // Aggiunto per utilizzare la facades Auth
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showOrders()
    {
        // Recupera l'ID del ristorante dell'utente autenticato
        $userRestaurantId = Auth::user()->restaurant->id;

        // Recupera tutti gli ordini dal database con i piatti e i rispettivi restaurant_id
        $orders = Order::with('plates')
            ->orderByDesc('created_at')
            ->get();

        // Passa gli ordini e l'ID del ristorante alla vista
        return view('admin.orders.index', compact('orders', 'userRestaurantId'));
    }

    public function orderStatistics()
    {
        // Recupera l'ID del ristorante dell'utente autenticato
        $userRestaurantId = Auth::user()->restaurant->id;

        // Calcola le statistiche degli ordini solo per il ristorante dell'utente autenticato
        $statistics = $this->calculateOrderStatistics($userRestaurantId);

        // Restituzione della risposta in formato JSON
        return view('admin.orders.statistics', compact('statistics'));
    }

    private function calculateOrderStatistics($restaurantId)
    {
        return Order::whereHas('plates', function ($query) use ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        })
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(id) as total_orders, SUM(total_orders) as total_quantity, SUM(total_orders) as total_sales')
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->get();
    }
}
