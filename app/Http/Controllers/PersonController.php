<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = Person::all();
        return response()->json(['people' => $people], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|string|email|unique:people',
            'phone' => 'nullable|string',
        ]);

        $person = new Person([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'date_of_birth' => $request->input('date_of_birth'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);
        $person->save();

        return response()->json(['message' => 'Person created successfully', 'person' => $person], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }
        return response()->json(['person' => $person], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }

        $request->validate([
            'first_name' => 'string',
            'last_name' => 'string',
            'date_of_birth' => 'date',
            'gender' => 'string',
            'email' => 'string|email|unique:people,email,' . $person->id,
            'phone' => 'nullable|string',
        ]);

        $person->first_name = $request->input('first_name', $person->first_name);
        $person->last_name = $request->input('last_name', $person->last_name);
        $person->date_of_birth = $request->input('date_of_birth', $person->date_of_birth);
        $person->gender = $request->input('gender', $person->gender);
        $person->email = $request->input('email', $person->email);
        $person->phone = $request->input('phone', $person->phone);
        $person->save();

        return response()->json(['message' => 'Person updated successfully', 'person' => $person], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }
        $person->delete();
        return response()->json(['message' => 'Person deleted successfully'], 200);
    }
}
