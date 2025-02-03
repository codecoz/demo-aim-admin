<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['prefix' => 'product', 'middleware' => ['web', 'auth']], function () {
    Route::get('/', [ProductController::class, 'list'])->name('product.list');
    Route::get('/show/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/update', [ProductController::class, 'update'])->name('product.update');
    Route::post('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/create', [ProductController::class, 'store'])->name('product.store');
});
