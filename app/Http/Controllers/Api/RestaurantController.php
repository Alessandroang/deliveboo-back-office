<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\Type;

class RestaurantController extends Controller
{
    public function index()
    {
        //Specifichiamo i campi che vogliamo vedere in vue
        $restaurant = Restaurant::all()
            ->with('restaurant_type: restaurant_id', 'type:id, name')
            ->orderByDesc('id')
            ->where('visibility', 1)
            ->paginate(6);
        return response()->json($restaurant);
    }
    public function show($id)
    {

        $restaurant = Restaurant::with('restaurant_type: restaurant_id', 'type:id, name')
            ->where('id', $id)
            ->first();
        if (!$restaurant)
            abort(404, "Ristorante non trovato");
        return response()->json($restaurant);
    }

    public function projectByType($type_id)
    {
        $type = Type::find($type_id);

        if (!$type)
            abort(404, "Tipo non trovato");

        $restaurants = Restaurant::with('type:id,name')
            ->orderBy('id', 'desc')
            ->where('type_id', $type_id)
            ->paginate(6);

        return response()->json(
            $restaurants
        );
    }
}