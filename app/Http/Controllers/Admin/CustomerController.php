<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MyHelpers;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Customer;
use App\Models\Route;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $customers = Customer::all();
            return view('pages.admin.customer.index', [
                'customers' => $customers,
            ]);
        } catch (Exception $e) {
            return redirect()->route('customer.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $cities = City::all();
            $jenisKelamins = ['Pria', 'Wanita'];
            return view('pages.admin.customer.create', [
                'cities' => $cities,
                'genders' => $jenisKelamins,
            ]);
        } catch (Exception $e) {
            return redirect()->route('customer.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'tanggal' => 'required',
                'nik' => 'required',
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'umur' => 'required|numeric',
                'alamat' => 'required',
                'no_telephone' => 'required',
                'kota_asal' => 'required',
                'kota_tujuan' => 'required',
                'harga_tiket' => 'required',
            ]);

            if ($validation->fails()) {
                return redirect()->route('customer.create')->withErrors($validation)->withInput();
            }

            $hargaTiket = MyHelpers::changeRupiahtoInteger($request->harga_tiket);
            $hargaBagasi = MyHelpers::changeRupiahtoInteger($request->harga_bagasi);

            if ($request->hasFile('photo_ktp')) {
                $file = $request->file('photo_ktp')->store('uploads/ktp', 'public');
            }

            //buatkan saya semua input request didalam 1 variable data
            $data = [
                'tanggal' => $request->tanggal,
                'nik' => $request->nik,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telephone' => $request->no_telephone,
                'kota_asal' => $request->kota_asal,
                'kota_tujuan' => $request->kota_tujuan,
                'photo_ktp' => $file ?? null,
                'umur' => $request->umur,
                'jenis_kelamin' => $request->jenis_kelamin,
                'harga_tiket' => $hargaTiket,
                'harga_bagasi' => $hargaBagasi,
                'keterangan_bagasi' => $request->keterangan_bagasi,
            ];
            Customer::create($data);

            return redirect()->route('customer.index')->with('success', 'Data ticket customer created successfully');
        } catch (Exception $e) {
            return redirect()->route('customer.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptId)
    {
        try {
            $id = MyHelpers::decode($encryptId);
            $customer = Customer::findOrFail($id);
            $cities = City::all();
            $jenisKelamins = ['Pria', 'Wanita'];
            return view('pages.admin.customer.edit', [
                'customer' => $customer,
                'cities' => $cities,
                'genders' => $jenisKelamins,
            ]);
        } catch (Exception $e) {
            return redirect()->route('customer.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        try {
            $validation = Validator::make($request->all(), [
                'tanggal' => 'required',
                'nik' => 'required',
                'nama' => 'required',
                'alamat' => 'required',
                'no_telephone' => 'required',
                'kota_asal' => 'required',
                'kota_tujuan' => 'required',
                'umur' => 'required|numeric',
                'jenis_kelamin' => 'required',
                'harga_tiket' => 'required',
            ]);

            if ($validation->fails()) {
                return redirect()
                    ->route('customer.edit', MyHelpers::encode($customer->id))
                    ->withErrors($validation)
                    ->withInput();
            }

            $hargaTiket = MyHelpers::changeRupiahtoInteger($request->harga_tiket);
            $hargaBagasi = MyHelpers::changeRupiahtoInteger($request->harga_bagasi);

            if ($request->hasFile('photo_ktp')) {
                Storage::delete($customer->photo_ktp);
                $file = $request->file('photo_ktp')->store('uploads/ktp', 'public');
                $customer->photo_ktp = $file;
            }

            $data = [
                'tanggal' => $request->tanggal,
                'nik' => $request->nik,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telephone' => $request->no_telephone,
                'kota_asal' => $request->kota_asal,
                'kota_tujuan' => $request->kota_tujuan,
                'photo_ktp' => $file ?? $customer->photo_ktp,
                'umur' => $request->umur,
                'jenis_kelamin' => $request->jenis_kelamin,
                'harga_tiket' => $hargaTiket,
                'harga_bagasi' => $hargaBagasi,
                'keterangan_bagasi' => $request->keterangan_bagasi,
            ];

            $customer->update($data);

            return redirect()->route('customer.index')->with('success', 'Data ticket customer updated successfully');
        } catch (Exception $e) {
            return redirect()->route('customer.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            Storage::delete($customer->photo_ktp);
            $customer->delete();
            return redirect()->route('customer.index')->with('success', 'Data ticket customer deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('customer.index')->with('error', $e->getMessage());
        }
    }

    // RuteController.php
    public function cekRute(Request $request)
    {
        $kotaAsal = $request->input('kota_asal');
        $kotaTujuan = $request->input('kota_tujuan');

        $rute = Route::where(function ($query) use ($kotaAsal, $kotaTujuan) {
            $query->where('kota_asal', $kotaAsal)->where('kota_tujuan', $kotaTujuan);
        })
            ->orWhere(function ($query) use ($kotaAsal, $kotaTujuan) {
                $query->where('kota_asal', $kotaTujuan)->where('kota_tujuan', $kotaAsal);
            })
            ->first();

        if ($rute) {
            return response()->json(['harga_tiket' => $rute->harga_tiket], 200);
        }

        return response()->json(['message' => 'Rute tidak ditemukan'], 404);
    }
}
