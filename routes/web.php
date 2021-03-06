<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [GameController::class, 'index']);
Route::get('/game', [GameController::class, 'game']);
Route::get('/game/{id}', [GameController::class, 'startGame']);
Route::get('/statistics/{id}', [GameController::class, 'statistics'])->name('statistics');
