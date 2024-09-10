<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\RoleController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Models\Vehicle;
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
        Route::get('/users', [UserController::class, 'index'])->name('superadmin-user-management');
        Route::post('/user', [UserController::class, 'store'])->name('superadmin-user-store');
        Route::put('/user/edit/{id}', [UserController::class, 'update'])->name('superadmin-user-update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('superadmin-user-destroy');
        Route::get('/roles', [RoleController::class, 'index'])->name('superadmin-role-management');
    });


    Route::prefix('admin')->middleware('admin')->group(function(){
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin');

        Route::resource('driver', DriverController::class);
        Route::resource('vehicle', VehicleController::class);
        Route::get('vehicle/media/{id}', [VehicleController::class, 'createMedia'])->name('vehicle.media');
        Route::post('vehicle/media/{id}', [VehicleController::class, 'storeFile'])->name('vehicle.media.store');

        Route::post('/vehicle/{id}/upload-file', [VehicleController::class, 'uploadVehicleFile'])->name('upload.vehicle.file');
        Route::get('/vehicle/{id}/files', [VehicleController::class, 'getVehicleFiles'])->name('vehicle.files');
        Route::delete('/vehicle/file/delete/{id}', [VehicleController::class, 'deleteVehicleFile'])->name('vehicle.file.delete');

        Route::resource('route', RouteController::class);
        Route::resource('city', CityController::class);

        Route::resource('customer', CustomerController::class);
        Route::post('cek-rute', [CustomerController::class, 'cekRute'])->name('cek-rute');

        Route::resource('transaction', TransactionController::class);
    });


    Route::get('/setting/profile', [SettingController::class, 'index'])->name('setting-profile');
    Route::put('/setting/profile/update', [SettingController::class, 'updateProfile'])->name('setting-profile-update');
    Route::get('/setting/password', [SettingController::class, 'changePassword'])->name('setting-password');
    Route::get('/setting/password/update', [SettingController::class, 'updatePassword'])->name('setting-password-update');
    
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::fallback([Controller::class, 'error404']);

