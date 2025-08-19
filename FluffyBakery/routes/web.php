<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


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
})->name('home');

Route::post('/', [AuthController::class, 'store'])->name('store');
Route::post('/login', [AuthController::class, 'loguear'])->name('loguear');
Route::get('/indexgeneral', [AuthController::class, 'indexgeneral'])->name('indexgeneral');

// Rutas de verificación de email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    // Loguear automáticamente al usuario después de verificar
    Auth::login($request->user());
    return redirect('/dashboard'); 
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Se ha reenviado el link de verificación a tu correo.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Rutas protegidas que requieren autenticación y email verificado
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');
});
