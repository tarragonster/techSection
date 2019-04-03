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

//Route::get('/hello', function () {
//    return 'Hello World';
//});


Route::get('/', 'PagesController@index');


Route::get('/lists', 'ListController@index');
Route::get('/lists/{list}','ListController@show');

Route::get('/dictionary', 'DictionariesController@dictionary');
Route::any('/search', 'DictionariesController@search');

Route::resource('posts', 'PostsController');

Route::any('test','DictionariesController@test');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('users/logout','Auth\LoginController@userLogout')->name('user.logout');


    Route::prefix('admin')->group(function(){
        Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
        Route::get('/', 'AdminController@index')->name('admin.dashboard');
        Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
    });
Route::post('/search/store', 'DictionariesController@store');
Route::post('/search/list', 'DictionariesController@showList');
Route::get('/search/dropdown','DictionariesController@ajaxList');
