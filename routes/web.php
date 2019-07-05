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
   Route::get('/add_products', "Add_Product@index");
   Route::post('/add_products', "Add_Product@store");
   Route::get('/category/show_sub/{id}', "Category_Controller@show_all_subcats_of_a_product");
   Route::delete("/category/clean_main/", "Category_Controller@delete_all_subs_from_main");
});
