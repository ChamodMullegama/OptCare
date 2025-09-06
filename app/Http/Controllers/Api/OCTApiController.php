<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OctAnalysis;
use Illuminate\Http\Request;

class OCTApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $analyses = OctAnalysis::all();
        return response()->json($analyses, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
            'doctor_id' => 'required|integer',
            'doctor_name' => 'required|string|max:255',
            'patient_id' => 'required|integer',
            'patient_name' => 'required|string|max:255',
            'patient_email' => 'required|email',
            'patient_phone' => 'required|string|max:15',
            'patient_age' => 'required|integer',
            'eye_side' => 'required|string|in:left,right',
            'clinical_notes' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);


        $path = $request->file('image')->store('oct_images', 'public');

        $prediction = "Possible retinal abnormality detected";
        $recommendation = "Refer to ophthalmologist for further evaluation";

        // Save to DB
        $analysis = OctAnalysis::create([
            'doctor_id' => $request->doctor_id,
            'doctor_name' => $request->doctor_name,
            'patient_id' => $request->patient_id,
            'patient_name' => $request->patient_name,
            'patient_email' => $request->patient_email,
            'patient_phone' => $request->patient_phone,
            'patient_age' => $request->patient_age,
            'eye_side' => $request->eye_side,
            'clinical_notes' => $request->clinical_notes,
            'image_path' => $path,
            'prediction' => $prediction,
            'recommendation' => $recommendation,
        ]);

        return response()->json([
            'message' => 'OCT analysis added successfully.',
            'data' => $analysis
        ], 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
