<?php

namespace App\Http\Controllers\Admin;
use App\Models\Restaurant;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        // Recupera il ristorante solo per il ristoratore autenticato
        $restaurant = auth()->user()->restaurant;

        return view('admin.restaurants.index', compact('restaurant'));
    }

    public function create()
    {
        return view('admin.restaurants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|alpha|max:50',
            'address' => 'required|string',
            'image' => 'required|url',
            'description' => 'required|string',
            'phone' => 'required|numeric|max:20',
            // ... altre regole di validazione
        ]);
        $userId = auth()->id();

        if (!$userId) {
            return redirect()
                ->back()
                ->with('error', 'Errore nell\'autenticazione dell\'utente.');
        }
        $restaurant = new Restaurant([
            'user_id' => $userId,
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'image' => $request->input('image'),
            'description' => $request->input('description'),
            'phone' => $request->input('phone'),
            // ... altre colonne del tuo modello Restaurant
        ]);

        $restaurant->save();
        return redirect()
            ->route('admin.restaurants.index')
            ->with('success', 'Ristorante registrato con successo!');
    }
}
