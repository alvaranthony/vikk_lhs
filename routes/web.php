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

Route::get('/instructor/theses', 'ThesesController@instructorTheses');

Route::resource('theses', 'ThesesController');

Route::resource('internships', 'InternshipController');

Route::get('fileentry', 'HomeController@index');

Route::get('fileentry/get/{filename}', [
	'as' => 'getentry', 'uses' => 'FileEntryController@get']);
	
Route::post('fileentry/store',[ 
        'as' => 'storeentry', 'uses' => 'FileEntryController@store']);
        
Route::post('comment/store', 'CommentController@store');


//admin

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('groups', 'GroupController');