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
    return redirect()->route('login');
});

Auth::routes();
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::get('/logout', 'HomeController@logout')->name('logout');

// dashboard
Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');

// penghuni
Route::group(['prefix' => 'penghuni', 'as' => 'penghuni.'], function () {
    Route::get('/', 'Penghuni\PenghuniController@index')->name('index');
    Route::post('/getdata', 'Penghuni\PenghuniController@getdata')->name('getdata');
    Route::post('/add', 'Penghuni\PenghuniController@add')->name('add');
});

// parkir
Route::get('/parkir', 'Parkir\ParkirController@index')->name('parkir');


