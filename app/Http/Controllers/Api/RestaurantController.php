<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Type;
use App\Order;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    //Api restaurants with types
    public function index()
    {
        $restaurants = Restaurant::select("id", "user_id", "name", "address", "description", "phone", "image")

            ->orderByDesc('id')
            ->with(['types'])
            ->paginate(4);

        //with(['types'])->get() //->paginate(6);

        return response()->json($restaurants);
    }

    //Api types
    public function show()
    {
        $types = Type::all();
        return response()->json($types);
    }

    public function restaurantsByFilters(Request $request)
    {
        $filters = $request->all();

        $restaurants_query = Restaurant::select("id", "user_id", "name", "address", "description", "phone", "image")
            ->with('types:id,name')
            ->orderByDesc('id');

        if (!empty($filters['activeTypes'])) {
            foreach ($filters['activeTypes'] as $type) {
                $restaurants_query->whereHas('types', function ($query) use ($type) {
                    $query->where('type_id', $type);
                });
            }
        }

        $restaurants = $restaurants_query->paginate(6);

        return response()->json($restaurants);
    }

    /* //Api filteredRestaurants
     public function filtered($category)
     {
         if($category != "all") {
             $restaurants = User::whereHas('categories', function($query) use($category) {
                 $query->where('name', $category);
             })->get();
         } else {

             $restaurants = User::all();
         }


          foreach ($restaurants as $restaurant) {
              $categories = [];
              $categories = $restaurant->categories;
              $restaurant->categories = $categories;
          };

         return response()->json($restaurants);
     }*/

}