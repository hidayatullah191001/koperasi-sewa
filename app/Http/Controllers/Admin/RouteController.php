<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MyHelpers;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\KotaAsal;
use App\Models\KotaTujuan;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::all();
        return view('pages.admin.route.index', [
            'routes' => $routes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kotaAsals = City::where('type', 'Asal')->get();
        $kotaTujuans = City::where('type', 'Tujuan')->get();
        return view('pages.admin.route.create', [
            'kotaAsals' => $kotaAsals,
            'kotaTujuans' => $kotaTujuans,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kota_asal' => 'required',
            'kota_tujuan' => 'required',
            'harga_tiket' => 'required',
            'harga_carteran' => 'required',
            'jam_pemberangkatan' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('route.create')->withErrors($validator)->withInput();
        }

        $hargaTiket = MyHelpers::changeRupiahtoInteger($request->harga_tiket);
        $hargaCarteran = MyHelpers::changeRupiahtoInteger($request->harga_carteran);

        $data = [
            'kota_asal' => $request->kota_asal,
            'kota_tujuan' => $request->kota_tujuan,
            'harga_tiket' => $hargaTiket,
            'harga_carteran' => $hargaCarteran,
            'jam_pemberangkatan' => $request->jam_pemberangkatan,
        ];

        Route::create($data);
        return redirect()->route('route.index')->with('success', 'Route successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptId)
    {
        $id = MyHelpers::decode($encryptId);
        $route = Route::findOrFail($id);
        $kotaAsals = City::where('type', 'Asal')->get();
        $kotaTujuans = City::where('type', 'Tujuan')->get();

        return view('pages.admin.route.edit', [
            'route' => $route,
            'kotaAsals' => $kotaAsals,
            'kotaTujuans' => $kotaTujuans,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        $validator = Validator::make($request->all(), [
            'kota_asal' => 'required',
            'kota_tujuan' => 'required',
            'harga_tiket' => 'required',
            'harga_carteran' => 'required',
            'jam_pemberangkatan' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('route.edit')->withErrors($validator)->withInput();
        }

        $hargaTiket = MyHelpers::changeRupiahtoInteger($request->harga_tiket);
        $hargaCarteran = MyHelpers::changeRupiahtoInteger($request->harga_carteran);
        $route->update([
            'kota_asal' => $request->kota_asal,
            'kota_tujuan' => $request->kota_tujuan,
            'harga_tiket' => $hargaTiket,
            'harga_carteran' => $hargaCarteran,
            'jam_pemberangkatan' => $request->jam_pemberangkatan,
        ]);

        return redirect()->route('route.index')->with('success', 'Route successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        $route->delete();
        return redirect()->route('route.index')->with('success', 'Route successfully deleted!');
    }
}
