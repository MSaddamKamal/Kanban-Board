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



                   


            Route::middleware('auth')->put('items/sync', 'ItemController@sync');


        Route::resource('items','ItemController')->middleware(['auth']);


        
	
        
        Route::resource('categories','CategoryController')->middleware(['auth']);

         Route::middleware('auth')->post('export', 'FileController@exportDB');
