<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SuperAdmin\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check() && Auth::user()->role_id != null && Auth::user()->role->code == 'SUADM') {
        return redirect()->route('superadmin');
    }else if(Auth::check() && Auth::user()->role_id != null && Auth::user()->role->code == 'ADM'){
        return redirect()->route('admin');
    }else {
        return redirect()->route('login');
    }
});

Auth::routes();

Route::get('action-logout', [LoginController::class, 'logout'])->name('action-logout');

Route::group(['middleware'=> ['auth']], function(){
    Route::prefix('superadmin')->middleware('superadmin')->group(function(){
        Route::get('/', [DashboardController::class, 'index'])->name('superadmin');
    });


    Route::prefix('admin')->middleware('admin')->group(function(){
        Route::get('/', function(){
            echo "Masuk Admin";
        })->name('admin');
    });

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::fallback([Controller::class, 'error404']);

