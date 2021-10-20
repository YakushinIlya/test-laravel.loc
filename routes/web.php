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

Route::get('/', 'HomeController@index')->name('home');

//Авторизация
Route::group([
    'namespace' => 'User',
], function(){
    Route::match(['get', 'post'],'/register', 'RegisterController@register')->name('register');
    Route::match(['get', 'post'], '/login', 'LoginController@login')->name('login');
    Route::get('/logout', 'LoginController@logout')->name('logout');
});

//Админка
Route::group([
    'prefix'     => 'admin',
    'namespace'  => 'Admin',
    'middleware' => 'auth',
], function(){
    Route::get('/dashboard', 'DashboardController@index')->name('admin');

    //Пользователи
    Route::get('/users', 'UsersController@index')->name('admin.users');
    Route::match(['get', 'post'],'/users/create', 'UsersController@create')->name('admin.users.create');
    Route::match(['get', 'put'],'/users/update/{id}', 'UsersController@update')->name('admin.users.update');
    Route::delete('/users/delete/{id}', 'UsersController@delete')->name('admin.users.delete');

    //Записи
    Route::get('/posts', 'PostsController@index')->name('admin.posts');
    Route::match(['get', 'post'],'/posts/create', 'PostsController@create')->name('admin.posts.create');
    Route::delete('/posts/delete/{id}', 'PostsController@delete')->name('admin.posts.delete');
});
