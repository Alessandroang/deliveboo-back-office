<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Mail\PlateVisibility;

use App\Http\Controllers\Controller;
use App\Models\Plate;
use Illuminate\Http\Request;

class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * //@return \Illuminate\Http\Response
     */
    public function index()
    {
        $plates = Plate::orderByDesc('id')->paginate(6);
        return view("admin.plates.index", compact("plates"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * //@return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * //@return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $plate = new Plate;
        $plate->fill($data);
        $plate->save();
        return redirect()->route('admin.plates.index', $plate);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * //@return \Illuminate\Http\Response
     */
    public function show(Plate $plate)
    {
        return view('admin.plates.show', compact('plate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * //@return \Illuminate\Http\Response
     */
    public function edit(Plate $plate)
    {
        return view('admin.plates.edit', compact('plate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * //@return \Illuminate\Http\Response
     */
    public function update(Request $request, Plate $plate)
    {
        $data = $request->all();
        $plate->update($data);
        return redirect()->route('admin.plates.index', $plate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * //@return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function visibility(Plate $plate, Request $request)
    {

        $data = $request->all();
        $plate->visibility = !Arr::exists($data, 'visibility') ? 1 : null;
        $plate->save();

        $user = Auth::user();

        Mail::to($user->email)->send(new PlateVisibility($plate));

        return redirect()->back();
    }
}