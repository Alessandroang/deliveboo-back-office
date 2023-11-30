<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plate;

class PlateController extends Controller
{

    public function index()
    {
        $plates = Plate::select('id', 'restaurant_id', 'name', 'image', 'ingredients', 'description', 'price')->get();
        return response()->json($plates);
    }


    public function show($id)
    {
        $plate = Plate::select('id', 'restaurant_id', 'name', 'image', 'ingredients', 'description', 'price')->where('id', $id)->first();

        if (!$plate)
            abort(404, "Nessun piatto trovato");

        return response()->json($plate);
    }

    public function platesByRestaurant($restaurant_id)
    {
        $plates = Plate::select('id', 'restaurant_id', 'name', 'image', 'ingredients', 'description', 'price')
            ->where("restaurant_id", $restaurant_id)
            // ->where('published', 1)
            // ->with('restaurant:id,user_id,name,address,description,phone,image')
            ->orderByDesc('id')
            ->paginate(12);

        // foreach ($plates as $plate) {
        //     // $post->content = $post->getAbstract(200);
        //     $plate->image = $plate->getAbsUriImage();
        // }

        return response()->json($plates);
    }

}

