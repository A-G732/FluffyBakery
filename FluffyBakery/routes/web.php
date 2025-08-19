<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

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
    return view('users/indexgeneral');
});

Route::get('/', fn () => redirect()->route('productos.index'));
Route::resource('productos', ProductoController::class);
Route::post('/', [AuthController::class, 'store'])->name('store');
Route::get('/indexgeneral', [AuthController::class, 'indexgeneral'])->name('indexgeneral');
Route::post('/login', [AuthController::class, 'loguear'])->name('loguear');
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index')->middleware('auth');



