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
    Route::get('/dtl/{id}', 'Penghuni\PenghuniController@dtl')->name('dtl');
    Route::get('/edit/{id}', 'Penghuni\PenghuniController@edit')->name('edit');
    Route::post('/getdata', 'Penghuni\PenghuniController@getdata')->name('getdata');
    Route::post('/add', 'Penghuni\PenghuniController@add')->name('add');
    Route::delete('/delete/{id?}', 'Penghuni\PenghuniController@delete')->name('delete');
});

// master data
// gedung
Route::group(['prefix' => 'gedung', 'as' => 'gedung.'], function () {
    Route::get('/', 'Gedung\GedungController@index')->name('index');
    Route::get('/dtl/{id}', 'Gedung\GedungController@dtl')->name('dtl');
    Route::get('/edit/{id}', 'Gedung\GedungController@edit')->name('edit');
    Route::post('/getdata', 'Gedung\GedungController@getdata')->name('getdata');
    Route::post('/add', 'Gedung\GedungController@add')->name('add');
    Route::delete('/delete/{id?}', 'Gedung\GedungController@delete')->name('delete');
});

// parkir
Route::group(['prefix' => 'parkir', 'as' => 'parkir.'], function () {
    Route::get('/', 'Parkir\ParkirController@index')->name('index');

});


