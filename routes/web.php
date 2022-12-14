<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CategoryController;

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

// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::middleware(['auth', 'Admin'])->group(function () {
    Route::resource('category', CategoryController::class);
    Route::get('category/{category}',[CategoryController::class, 'destroy']);
    Route::get('user', [UserController::class, 'beranda']);
    Route::put('ubah/{user}', [UserController::class, 'ubahData']);
});


Route::middleware(['auth', 'Editor'])->group(function () {
    Route::resource('book', BookController::class);
    Route::get('book/{book}',[BookController::class, 'destroy']);
    Route::get('tampil/{book}', [BookController::class, 'hide']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('read/{id}', [BerandaController::class, 'read']);
});

Route::get('/', [BerandaController::class, 'Beranda']);
Route::get('{id}', [BerandaController::class, 'kategori']);
Route::post('beranda', [FilterController::class, 'store']);
// Route::post('beranda', [FilterController::class, 'store']);



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
