<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::all();
        return response()->json(['families' => $families], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:families,name',
        ]);

        $family = Family::create($request->all());

        return response()->json(['message' => 'Family created successfully', 'family' => $family], 201);
    }

    public function show($id)
    {
        $family = Family::find($id);
        if (!$family) {
            return response()->json(['message' => 'Family not found'], 404);
        }
        return response()->json(['family' => $family], 200);
    }

    public function update(Request $request, $id)
    {
        $family = Family::find($id);
        if (!$family) {
            return response()->json(['message' => 'Family not found'], 404);
        }

        $request->validate([
            'name' => 'string|unique:families,name,' . $family->id,
        ]);

        $family->update($request->all());

        return response()->json(['message' => 'Family updated successfully', 'family' => $family], 200);
    }

    public function destroy($id)
    {
        $family = Family::find($id);
        if (!$family) {
            return response()->json(['message' => 'Family not found'], 404);
        }
        $family->delete();
        return response()->json(['message' => 'Family deleted successfully'], 200);
    }
}
