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

Route::get('/','FrontendController@index')->name('index');
Route::get('brand/{id}','FrontendController@brand')->name('brand');
Route::get('promotion','FrontendController@promotion')->name('promotion');
Route::get('shoppingcart','FrontendController@shoppingcart')->name('shoppingcart');
Route::post('order','FrontendController@order')->name('order');

Route::get('ordersuccess','FrontendController@ordersuccess')->name('ordersuccess');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// basic routes
// Get method
Route::get('hello','TestOneController@index');
// post
Route::post('hi','TestOneController@index');
// For all method
//get ,post,add,update,delete,option
Route::resource('test','TestTwoController');
//route parameter
//get method
Route::get('user/{id}','TestThreecontroller@show');
Route::get('hellouser/{name}/{position}/{city}','TestOneController@user');

//Backend

Route::group(['middleware'=>'role:admin','prefix'=>'backside','as'=>'backside.'],function(){
	Route::resource('/category','CategoryController');
Route::resource('/subcategory','SubCategoryController');
Route::resource('/brand','BrandController');
Route::resource('/item','ItemController');
Route::resource('/township','TownshipController');

});


