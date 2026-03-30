<?php

namespace App\Http\Controllers;

use App\Models\Maladie;
use Illuminate\Http\Request;

class MaladieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Maladie::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rarete' => 'in:faible,moyenne,haute'
        ]);
        // dd($validated);

        $maladie = Maladie::create($validated);
        return $maladie;
    }

    /**
     * Display the specified resource.
     */
    public function show(Maladie $maladie)
    {
        //
        return $maladie;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maladie $maladie)
    {
        //
        $maladie->update($request->all());
        return $maladie;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maladie $maladie)
    {
        //
        $maladie->delete();
    }
}
