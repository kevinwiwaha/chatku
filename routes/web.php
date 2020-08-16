<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/tes', 'ChatController@tes');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::view('/chat', 'chat.index')->middleware('auth');
Route::post('/chat/store', 'ChatController@store');
Route::get('/chat/all', 'ChatController@index')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('home');
