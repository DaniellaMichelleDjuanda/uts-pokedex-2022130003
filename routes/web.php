<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PokedexController;


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


Route::get('/', PokedexController::class)->name('pokedex');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/pokemon', [PokemonController::class, 'index'])->name('pokemon.index');
Route::get('/pokemon/create', [PokemonController::class, 'create'])->name('pokemon.create');
Route::post('/pokemon', [PokemonController::class, 'store'])->name('pokemon.store');
Route::get('/pokemon/{pokemon}/edit', [PokemonController::class, 'edit'])->name('pokemon.edit');
Route::put('/pokemon/{pokemon}', [PokemonController::class, 'update'])->name('pokemon.update');

Route::resource('pokemons', PokemonController::class);
