<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MyHelpers;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Transaction;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $transactions = Transaction::all();
            return view('pages.admin.transaction.index', [
                'transactions' => $transactions,
            ]);
        } catch (Exception $e) {
            return redirect()->route('transaction.index')->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $drivers = Driver::where('is_active', 'yes')->get();
            $vehicles = Vehicle::all();
            $customers = Customer::all();
            $cities = City::all();
            return view('pages.admin.transaction.create', [
                'drivers' => $drivers,
                'vehicles' => $vehicles,
                'customers' => $customers,
                'cities' => $cities,
            ]);
        } catch (Exception $e) {
            return redirect()->route('transaction.create')->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'tanggal_transaksi' => 'required|date',
                'pembayaran' => 'required',
                'tanggal_pemberangkatan' => 'required|date',
                'driver_id' => 'required|exists:drivers,id',
                'vehicle_id' => 'required|exists:vehicles,id',
                'customer_id' => 'required|exists:customers,id',
                'kota_asal_id' => 'required|exists:cities,id',
                'kota_tujuan_id' => 'required|exists:cities,id',
            ]);

            if ($validation->fails()) {
                return redirect()->route('transaction.create')->withErrors($validation)->withInput();
            }

            Transaction::create($request->all());

            return redirect()->route('transaction.index')->with('success', 'Transaction successfully created!');
        } catch (Exception $e) {
            return redirect()->route('transaction.create')->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptId)
    {
        try {
            $id = MyHelpers::decode($encryptId);
            $transaction = Transaction::findOrFail($id);
            return view('pages.admin.transaction.view', [
                'transaction' => $transaction
            ]);
        } catch (Exception $e) {
            return redirect()->route('transaction.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptId)
    {
        try {
            $id = MyHelpers::decode($encryptId);
            $transaction = Transaction::findOrFail($id);
            $drivers = Driver::where('is_active', 'yes')->get();
            $vehicles = Vehicle::all();
            $customers = Customer::all();
            $cities = City::all();

            return view('pages.admin.transaction.edit', [
                'transaction' => $transaction,
                'drivers' => $drivers,
                'vehicles' => $vehicles,
                'customers' => $customers,
                'cities' => $cities,
            ]);
        } catch (Exception $e) {
            return redirect()->route('transaction.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        try {
            $validation = Validator::make($request->all(), [
                'tanggal_transaksi' => 'required|date',
                'pembayaran' => 'required',
                'tanggal_pemberangkatan' => 'required|date',
                'driver_id' => 'required|exists:drivers,id',
                'vehicle_id' => 'required|exists:vehicles,id',
                'customer_id' => 'required|exists:customers,id',
                'kota_asal_id' => 'required|exists:cities,id',
                'kota_tujuan_id' => 'required|exists:cities,id',
            ]);

            if ($validation->fails()) {
                return redirect()->route('transaction.create')->withErrors($validation)->withInput();
            }

            $transaction->update($request->all());

            return redirect()->route('transaction.index')->with('success', 'Transaction successfully updated!');
        } catch (Exception $e) {
            return redirect()->route('transaction.create')->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        try {
            $transaction->delete();
            return redirect()->route('transaction.index')->with('success', 'Transaction successfully deleted!');
        } catch (Exception $e) {
            return redirect()->route('transaction.index')->with('error', $e->getMessage());
        }
    }
}
