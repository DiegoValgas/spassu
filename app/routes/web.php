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
Route::put('books/{book}/add-author', [BooksController::class, 'addAuthor'])->name('books.add-author');
Route::delete('books/{book}/remove-author/{author}', [BooksController::class, 'removeAuthor'])->name('books.remove-author');
Route::put('books/{book}/add-subject', [BooksController::class, 'addSubject'])->name('books.add-subject');
Route::delete('books/{book}/remove-subject/{subject}', [BooksController::class, 'removeSubject'])->name('books.remove-subject');

/**
 * Report route.
 */
Route::get('report', [BooksController::class, 'report'])->name('report');

/**
 * Author routes.
 */
Route::resource('authors', AuthorsController::class)->except('show');

/**
 * Subject routes.
 */
Route::resource('subjects', SubjectsController::class)->except('show');

/**
 * CSRF token routes.
 */
Route::get('/csrf-token', fn () => response()->json(['csrf_token' => csrf_token()]));
