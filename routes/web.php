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


Auth::routes();


Route::middleware(['auth'])->group(function(){
    Route::get('/', function () {
        return redirect()->route('home');
    });

    Route::get('/admin/dashboard', 'HomeController@index')->name('home');
    Route::get('/admin/users', function () {
        return view('admin.users.index');
    })->name('users');
    Route::post('/admin/users/all', 'AclUserController@getUsersWithSearch')->name('users.search');
    Route::get('/admin/users/roles/all', 'AclUserController@getAllRoles')->name('roles.all');
    Route::post('/admin/users/create', 'AclUserController@createUser')->name('users.create');
    Route::post('/admin/users/get', 'AclUserController@editUser')->name('users.first');
    Route::post('/admin/users/update', 'AclUserController@updateUser')->name('users.update');
    Route::post('/admin/users/delete', 'AclUserController@deleteUser')->name('users.delete');

    Route::get('/admin/categories', function () {
        return view('admin.categories.index');
    })->name('categories');

    Route::post('/admin/categories/all', 'CategoriesController@index')->name('categories.search');
    Route::post('/admin/categories/create', 'CategoriesController@create')->name('categories.create');
    Route::post('/admin/categories/delete', 'CategoriesController@delete')->name('categories.delete');
    Route::post('/admin/categories/get', 'CategoriesController@edit')->name('categories.get');
    Route::post('/admin/categories/update', 'CategoriesController@update')->name('categories.update');
});
