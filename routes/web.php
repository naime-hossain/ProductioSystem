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

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin','middleware'=>'auth'], function() {

    // worker
	Route::resource('/worker','WorkerController',['except'=>['create','edit','show']]);
	
	// product for production
	Route::resource('/workitem','WorkItemController',['except'=>['create','edit','show']]);

	// New production entry
	Route::resource('/production','ProductionController',['except'=>['create','edit','show']]);
});
