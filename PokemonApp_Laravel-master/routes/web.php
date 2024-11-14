<?php

//package, import
use App\Http\Controllers\MainController;
use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

//Defino las rutas
//1, página principal
Route::get('/', [MainController::class, 'main'])-> name('main');
//2, log in
Route::get('login', [MainController::class, 'login'])-> name('login');
//3, log out
Route::get('logout', [MainController::class, 'logout'])-> name('logout');
//4, 7 rutas (create, destroy, edit, index, show, store, update)
Route::resource('pokemon', PokemonController::class);