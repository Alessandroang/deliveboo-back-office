<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Type;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
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
        $types = Type::all();
        return view('admin.restaurants.create', compact('types'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string',
            'image' => 'required|image',
            'description' => 'required|string',
            'phone' => 'required|string|min:8|max:20',
            // 'type_id' => 'nullable|exists:types,id',
            // 'types' => ['nullable', 'array', 'exists:types,id'],
            // ... altre regole di validazione
        ]);

        $userId = auth()->id();

        if (!$userId) {
            return redirect()
                ->back()
                ->with('error', 'Errore nell\'autenticazione dell\'utente.');
        }

        // Creare un nuovo ristorante
        $restaurant = new Restaurant([
            'user_id' => $userId,
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'image' => $request->input('image'),
            'description' => $request->input('description'),
            'phone' => $request->input('phone'),
            // 'type_id' => $request->input('type_id'),
            // ... altre colonne del tuo modello Restaurant
        ]);

        // # METTIAMO L'IMMAGINE IN UNA CARTELLA TRAMITE LO STORAGE E QUELLO CHE CI ARRIVA(put)
        if ($request->hasFile('image')) {
            $imagePath = Storage::put('upload/restaurants/images', $request->file('image'));
            // # NEL DB METTIAMO IL PATH
            $restaurant->image = $imagePath;
        }


        // Salva il ristorante nel database
        $restaurant->save();

        // Associa i tipi al ristorante
        $restaurant->types()->attach($request->input('types'));

        return redirect()
            ->route('admin.restaurants.index')
            ->with('success', 'Ristorante registrato con successo!');
    }
}