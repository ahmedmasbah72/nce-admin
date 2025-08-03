<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCartController;
use App\Http\Controllers\AdminCartController;



Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::resource('people', PersonController::class);
Route::get('people/Show/{id}', [PersonController::class,'show']);

// Cart routes
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('cart/generateQuote', [CartController::class, 'generateQuote'])->name('cart.generateQuote');
Route::post('/cart/generateQuote', [CartController::class, 'generateQuote'])->name('cart.generateQuote');

// Authentication routes
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/admin', [AdminController::class, 'showAdmin'])->name('admin.view');
Route::get('/user', [UserController::class, 'showUser'])->name('user.view');

// UserCart routes
Route::post('/usercart/add/{id}', [UserCartController::class, 'addToCart'])->name('usercart.add');
Route::get('/usercart', [UserCartController::class, 'showCart'])->name('usercart.index');
Route::post('/usercart/update', [UserCartController::class, 'updateCart'])->name('usercart.update');
Route::post('/usercart/remove', [UserCartController::class, 'removeFromCart'])->name('usercart.remove');
Route::post('/usercart/generateQuote', [UserCartController::class, 'generateQuote'])->name('usercart.generateQuote');


// Route::get('/admincart', [AdminCartController::class, 'showCart'])->name('admincart.index');
Route::post('/admincart/add/{id}', [AdminCartController::class, 'addToCart'])->name('admincart.add');
Route::post('/admincart/update', [AdminCartController::class, 'updateCart'])->name('admincart.update');
Route::post('/admincart/remove', [AdminCartController::class, 'removeFromCart'])->name('admincart.remove');
Route::post('/admincart/generate-quote', [AdminCartController::class, 'generateQuote'])->name('admincart.generateQuote');
Route::get('/admincart', [AdminCartController::class, 'showCart'])->name('admin.admincart');


