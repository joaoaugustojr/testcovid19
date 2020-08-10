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

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::group([
    'namespace' => 'Web',
    'prefix' => 'dashboard',
], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/forms', 'FormController@index')->name('forms.index');
});
