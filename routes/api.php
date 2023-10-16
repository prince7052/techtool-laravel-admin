<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::controller(AuthController::class)->group(function(){
   
    Route::post('login', 'login');
    
});
Route::controller(DashboardController::class)->group(function(){
   
    Route::get('dashboard/{id}', 'dashboard');
    Route::post('update_record/{id}/{cid}', 'update_record');
    Route::get('follow_up/{id}', 'follow_up');
});
        
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('dashboard', AuthController::class);
    Route::resource('products', ProductController::class);
});
