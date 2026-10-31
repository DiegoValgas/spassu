<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\SubjectsController;
use Illuminate\Support\Facades\Route;

/**
 * Books routes.
 */
Route::redirect('/', '/books');
Route::resource('books', BooksController::class)->except('show');

/**
 * Author routes.
 */
Route::resource('authors', AuthorsController::class)->except('show');

/**
 * Subject routes.
 */
Route::resource('subjects', SubjectsController::class)->except('show');