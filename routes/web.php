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

Route::get('/', function(){
  return view('welcome');
});

Route::resource('products', 'productController');

Route::resource('groups', 'groupController');
                
Route::resource('tours', 'tourController');
                
Route::resource('agendas', 'agendaController');
                
Route::resource('users', 'userController');
                
Route::resource('posts', 'dashboardController');

Auth::routes();

Route::get('groups/filter/search', 'groupController@search');

Route::get('tours/filter/search', 'tourController@search');

Route::get('/dashboard', 'dashboardController@index')->name('dashboard');

Route::get('tours/filter/nostatusclosed', 'tourController@noStatusClosed');

Route::get('tours/filter/nousersassigned', 'tourController@noUsersAssigned');

Route::get('tours/order/{id}/{dir}', 'tourController@orderBy');

Route::get('tours/filter/{day}/day', 'tourController@filterByDay');

Route::get('tours/filter/{week}/week', 'tourController@filterByWeek');

Route::get('tours/filter/{month}/month', 'tourController@filterByMonth');

Route::get('products/{id}/download', 'productController@download');

