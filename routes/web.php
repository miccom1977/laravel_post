<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PostController,CategoryController
};

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

Route::get('/', [PostController::class,'index']);
Route::resource('posts', PostController::class)->name('profile','posts');
Route::resource('categories', CategoryController::class)->name('profile','categories');
