<?php

use App\Http\Controllers\CommentController;
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

Route::group(['middleware' => 'auth', 'prefix' => 'personal'], function () {
    Route::post('/', [PublicationController::class, 'store'])->name('publication.store');
    Route::get('/create', [PublicationController::class, 'create'])->name('publication.create');
    Route::get('/index', [PublicationController::class, 'index'])->name('publication.index');
    Route::get('/{publication}/show', [PublicationController::class, 'show'])->name('publication.show');
    Route::post('/{publication}/edit', [PublicationController::class, 'edit'])->name('publication.edit');
    Route::get('/{publication}/destroy', [PublicationController::class, 'destroy'])->name('publication.destroy');
    Route::get('/area', [UserController::class, 'index'])->name('personal.index');
    Route::post('/area', [UserController::class, 'update'])->name('personal.edit');
    Route::get('/{publication}/like', [PublicationController::class, 'like'])->name('liker');
    Route::get('/{publication}/dislike', [PublicationController::class, 'dislike'])->name('disliker');
    Route::post('/comment', [CommentController::class, 'create'])->name('comment.create');
    Route::get('{comment}/comment/destroy', [CommentController::class, 'destroy'])->name('comment.destroy');
});


require __DIR__.'/auth.php';
