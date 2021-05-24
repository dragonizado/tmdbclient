<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiteController;

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

Route::get('/',[SiteController::class,"index"])->name("site.index");
Route::get('/movies',[SiteController::class,"find"])->name("site.find");
Route::get('/movie/{id}/{local}',[SiteController::class,"show"])->name("site.movie.show");
Route::get('/movie/register',[SiteController::class,"create"])->name("site.movie.register");
Route::post('/movie/register',[SiteController::class,"store"])->name("site.movie.store");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
