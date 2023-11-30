<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Order; // Mancava questa dichiarazione
use Illuminate\Support\Facades\Auth; // Mancava questa dichiarazione

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('user_id', $user->id)->with('plates')->first();
        $orders = Order::where('restaurant_id', $restaurant->id)->with('plates')->orderByDesc('id')->get();

        $groupedOrders = $orders->map(function ($order) {
            $plates = $order->plates->groupBy('id')->map(function ($dishGroup) {
                return [
                    'id' => $dishGroup->first()->id,
                    'name' => $dishGroup->first()->name,
                    'quantity' => $dishGroup->count()
                ];
            });

            return [
                'id' => $order->id,
                'address_client' => $order->address_client,
                'total_price' => $order->total_price,
                'created_at' => $order->created_at,
                'email_client' => $order->email_client,
                'plates' => $plates
            ];
        });

        return view('guest.orders.index', ['groupedOrders' => $groupedOrders]); // Aggiunta chiusura della parentesi e correzione di return view
    }
}