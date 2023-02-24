<?php

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/meals', function () {
        return view('meals');
    })->name('meals');
    Route::get('/breakfast', function () {
        return view('breakfast');
    })->name('breakfast');
    Route::get('/lunch', function () {
        return view('lunch');
    })->name('lunch');
    Route::get('/snacks', function () {
        return view('snacks');
    })->name('snacks');
    Route::get('/others', function () {
        return view('others');
    })->name('others');
    Route::get('/users', function () {
        return view('users');
    })->name('users');
    Route::get('/orders', function () {
        return view('orders');
    })->name('orders');
    Route::get('/billings', function () {
        return view('billings');
    })->name('billings');
});
