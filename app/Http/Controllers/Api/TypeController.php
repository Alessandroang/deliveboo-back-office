<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     
*Store a newly created resource in storage.*
*@param  \Illuminate\Http\Request  $request
*@return \Illuminate\Http\Response
*/
    public function show($id)
    {
        $type = Type::with('retsaurants')->where('id', $id)->first();

        if (!$type)
            abort(404, "Tipo non trovato");

        return response()->json($type);
    }
}