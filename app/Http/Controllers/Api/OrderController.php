<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Plate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Braintree\Gateway;

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
            'cart' => 'required|array',
        ]);

        // Creazione di un nuovo ordine con i dati validati
        $order = Order::create([
            'name' => $validatedData['name'],
            'lastname' => $validatedData['lastname'],
            'address' => $validatedData['address'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'total_orders' => $validatedData['total_orders'],
        ]);

        // Itera sull'array 'cart' e inserisci i dati nella tabella ponte 'order_plate'
        foreach ($validatedData['cart'] as $cartItem) {
            $plateId = $cartItem['id']; // Supponendo che ci sia un campo 'plate_id' nell'elemento del carrello
            $quantity = $cartItem['qty']; // Supponendo che ci sia un campo 'quantity' nell'elemento del carrello

            // Trova il piatto dal carrello
            $plate = Plate::find($plateId);

            // Aggiungi il piatto all'ordine nella tabella ponte con la quantità
            $order->plates()->attach($plateId, ['quantity' => $quantity]);
        }

        // Restituzione della risposta in formato JSON
        return response()->json(
            [
                'order' => $order,
            ],
            201,
        );
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

    public function Generate(Request $request, Gateway $gateway, Order $order)
    {
        $token = $gateway->clientToken()->generate();
        $data = [
            'success' => true,
            'token' => $token,
        ];
        return response()->json($data, 200);
    }
    public function MakePayment(Request $request, Gateway $gateway, Order $order)
    {
        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);
        if ($result->success) {
            $data = [
                'message' => 'Transazione eseguita correttamente',
                'success' => true,
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Transazione rifiutata',
                'success' => false,
                'error' => $result->message,
            ];
            return response()->json($data, 401);
        }
    }
}