<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', [MovieController::class, 'index'])->name('home');

Route::get('/tes', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/movies/location/{name}', [MovieController::class, 'filterByLocation'])->name('movies.filterByLocation');
Route::resource('movies', MovieController::class);
Route::get('/coming-soon', [MovieController::class, 'comingSoon'])->name('movies.comingSoon');

Route::get('/about', function () {
    return view('about');
})->name('about');
