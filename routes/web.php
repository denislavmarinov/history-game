<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function() {
	// Routes only for admins
	Route::middleware(['admin'])->group(function() {
        // Questions controller routes
        Route::resource("/questions", "QuestionsController");
        Route::put("/questions/{question}/soft_delete", "QuestionsController@soft_delete")->name("questions.soft_delete");
        Route::put("/questions/{question}/return_in_game", "QuestionsController@return_in_game")->name("questions.return_in_game");
	});

	// Route for plain users
    Route::get("/game", "GameController@index")->name("game.index");
    Route::get("/game/get_a_question", "GameController@get_a_question")->name("game.get_a_question");
    Route::get("/game/over/ajax", "GameController@gameover_ajax")->name("game.over_ajax");
    Route::get("/game/over", "GameController@gameover")->name("game.over");
});