<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
   Route::resource('home', "HomeController");
   Route::resource('category', "Category_Controller");
});

Route::middleware(['auth'])->group(function () {
   Route::get('/add_products', "Add_Product@index");
   Route::post('/add_products', "Add_Product@store");
});
