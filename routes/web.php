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

Route::get('/','HomeController@index');
Auth::routes();


	// Route::middleware('auth')->get('/tasks','TaskController@index')->name('tasks.index');

	// Route::middleware('auth')->post('tasks', 'TaskController@store')->name('tasks.store');

	// 	Route::middleware('auth')->put('tasks/sync', 'TaskController@sync')->name('tasks.sync');


	// Route::middleware('auth')->put('tasks/{id}', 'TaskController@update')->name('tasks.update');




 

 //        Route::middleware('auth')->put('statuses/{id}', 'StatusController@update')->name('statuses.update');



 //                Route::middleware('auth')->delete('statuses/{id}', 'StatusController@destroy')->name('statuses.destroy');


 //                    Route::middleware('auth')->post('statuses', 'StatusController@store')->name('statuses.store');

                   


            Route::middleware('auth')->put('items/sync', 'ItemController@sync');


        Route::resource('items','ItemController')->middleware(['auth']);


        
	
        
        Route::resource('categories','CategoryController')->middleware(['auth']);

         Route::middleware('auth')->post('export', 'FileController@exportDB');
