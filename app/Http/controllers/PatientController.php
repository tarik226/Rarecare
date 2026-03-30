<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Patient::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dateofBirth' => 'required|date',  
            'gender' => 'required|string',
            'contactInfo' => 'required|string',
        ]);
        // dd($validated);

        $patient = Patient::create($validated);
        return $patient;
    }   

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
        $this->authorize('view patients', $patient);
        return $patient;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        //
        $this->authorize('update patients', $patient);
        $patient->update($request->all());
        return $patient;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
        $this->authorize('update patients', $patient);
        $patient->delete();
    }
}
