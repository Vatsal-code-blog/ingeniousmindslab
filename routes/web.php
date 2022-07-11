<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\shopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

## shopController
Route::group(['prefix'=>'/customer'], function(){
    Route::get('',[shopController::class,'index']);
    Route::get('/edit/{id}',[shopController::class,'Edit']);
    Route::get('/delete/{id}',[shopController::class,'Delete']);
    Route::post('/save/',[shopController::class,'Action']);
});