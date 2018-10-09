<?php

use App\Book;
use Illuminate\Http\Request;
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
// ダッシュボード表示
Route::get('/', 'BooksController@list');

// 新しい本を追加
Route::post('/books', 'BooksController@store');

// 本を削除
Route::delete('book/{book}', 'BooksController@delete');

Auth::routes();

Route::get('/home', 'BooksController@list')->name('home');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/{provider}'         , 'Auth\AuthController@redirectToProvider'    );
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
