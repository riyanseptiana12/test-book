<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;


Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/authors/top', [BookController::class, 'topAuthors'])->name('authors.top');
Route::get('/ratings/create', [BookController::class, 'createRating'])->name('ratings.create');
Route::post('/ratings', [BookController::class, 'storeRating'])->name('ratings.store');


Route::get('/api/authors/{author}/books', [BookController::class, 'getBooksByAuthor'])->name('api.authors.books');
