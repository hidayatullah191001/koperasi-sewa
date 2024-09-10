<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Route;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();

        $drivers = Driver::all();
        $vehicle = Vehicle::all();
        $route = Route::all();
        $customers = Customer::all();
        $transaction = Transaction::all();

        $lastTransaction = Transaction::orderBy('tanggal_transaksi', 'desc')->limit(5)->get();

        $todaySales = Transaction::where('tanggal_transaksi', today())->count();

        $now = Carbon::now();
        $monthRevenue = DB::table('transactions as tc')
            ->join('customers as cus', 'tc.customer_id', '=', 'cus.id')
            ->selectRaw('SUM(cus.harga_tiket + cus.harga_bagasi) as revenue')
            ->whereMonth('tc.created_at', $now->month)
            ->whereYear('tc.created_at', $now->year)
            ->first();

        $totalRevenue = $monthRevenue->revenue ?? 0;

        $transactions = Transaction::selectRaw('DATE(transactions.tanggal_transaksi) as date, SUM(customers.harga_tiket + customers.harga_bagasi) as revenue')
            ->join('customers', 'transactions.customer_id', '=', 'customers.id')
            ->whereYear('transactions.tanggal_transaksi', $now->year)
            ->whereMonth('transactions.tanggal_transaksi', $now->month)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartData = [];
        $chartCategories = [];

        foreach ($transactions as $transaction) {
            $chartData[] = $transaction->revenue;
            $chartCategories[] = $transaction->date;
        }

        return view('pages.superadmin.dashboard', [
            'users' => $users,
            'drivers' => $drivers,
            'vehicle' => $vehicle,
            'route' => $route,
            'customers' => $customers,
            'transaction' => $transaction,
            'lastTransaction' => $lastTransaction,
            'todaySales' => $todaySales,
            'totalRevenue' => $totalRevenue,
            'transactions' => $transactions,
            'chartData' => $chartData,
            'chartCategories' => $chartCategories,
        ]);
    }
}
