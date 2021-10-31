<?php

use App\Http\Controllers\PublicationController;
use App\Http\Controllers\UserController;
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

Route::get('/', [PublicationController::class, 'welcome'])->name('welcome');
Route::get('/{publication}/like', [PublicationController::class, 'liker'])->name('liker');
Route::get('/{publication}/dislike', [PublicationController::class, 'disliker'])->name('disliker');

Route::group(['middleware' => 'auth', 'prefix' => 'personal'], function () {
    Route::post('/', [PublicationController::class, 'store'])->name('publication.store');
    Route::get('/create', [PublicationController::class, 'create'])->name('publication.create');
    Route::get('/index', [PublicationController::class, 'index'])->name('publication.index');
    Route::get('/{publication}/show', [PublicationController::class, 'show'])->name('publication.show');
    Route::post('/{publication}/edit', [PublicationController::class, 'edit'])->name('publication.edit');
    Route::get('/{publication}/destroy', [PublicationController::class, 'destroy'])->name('publication.destroy');
    Route::get('/area', [UserController::class, 'index'])->name('personal.index');
    Route::post('/area', [UserController::class, 'update'])->name('personal.edit');
});


require __DIR__.'/auth.php';
