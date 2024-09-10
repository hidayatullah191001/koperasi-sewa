<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::all();
        $types = ['Asal', 'Tujuan'];
        return view('pages.admin.city.index', [
            'cities' => $cities,
            'types' => $types,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama' => 'required|string',
            'type' => 'required|string', 
        ]);
        if ($validation->fails()) {
            return redirect()->route('city.index')->withErrors($validation);
        }
        City::create($request->all());
        return redirect()->route('city.index')->with('success', 'City successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $city = City::findOrFail($id);
        $validation = Validator::make($request->all(), [
            'nama' => 'required|string',
            'type' => 'required|string', 
        ]);
        if ($validation->fails()) {
            return redirect()->route('city.index')->withErrors($validation);
        }
        $city->update($request->all());
        return redirect()->route('city.index')->with('success', 'City successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return redirect()->route('city.index')->with('success', 'City successfully deleted!');
    }
}
