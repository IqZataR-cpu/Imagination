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

Route::get('/', [\App\Http\Controllers\PublicationController::class, 'welcome'])->name('welcome');

Route::group(['middleware' => 'auth', 'prefix' => 'personal'], function () {
    Route::post('/', [\App\Http\Controllers\PublicationController::class, 'store'])->name('publication.store');
    Route::get('/create', [\App\Http\Controllers\PublicationController::class, 'create'])->name('publication.create');
    Route::get('/index', [\App\Http\Controllers\PublicationController::class, 'index'])->name('publication.index');
    Route::get('/{publication}/show', [\App\Http\Controllers\PublicationController::class, 'show'])->name('publication.show');
    Route::post('/{publication}/edit', [\App\Http\Controllers\PublicationController::class, 'edit'])->name('publication.edit');
    Route::get('/{publication}/destroy', [\App\Http\Controllers\PublicationController::class, 'destroy'])->name('publication.destroy');
    Route::get('/area', [\App\Http\Controllers\UserController::class, 'index'])->name('personal.index');
    Route::post('/area', [\App\Http\Controllers\UserController::class, 'update'])->name('personal.edit');
});


require __DIR__.'/auth.php';
