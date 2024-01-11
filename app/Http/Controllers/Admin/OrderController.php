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
        // Calcola le statistiche degli ordini
        $statistics = $this->calculateOrderStatistics();

        // Restituzione della risposta in formato JSON
        return view('admin.orders.statistics', compact('statistics'));
    }

    private function calculateOrderStatistics()
    {
        return Order::select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(id) as total_orders'), DB::raw('SUM(total_orders) as total_quantity'), DB::raw('SUM(total_orders) as total_sales'))
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->get();
    }
}