<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\GameSessionController;
use Illuminate\Support\Facades\Route;


// return all games
Route::get('games',[GamesController::class,'games']);

// return all the categories
Route::get('categories' , [CategoryController::class, 'getCategories']);
// start game session
Route::post('start-game-request' , [GameSessionController::class, 'sessionStart']);

Route::get('game-session/{id}/questions' , [GameSessionController::class, 'getQuestions']);


