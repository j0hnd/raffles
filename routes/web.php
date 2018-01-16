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

Route::group(['middleware' => 'web'], function () {
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('/{raffle}', 'RaffleEntriesController@registration')->name('registration');
    Route::post('/r/{raffle}/{raffle_id}', 'RaffleEntriesController@register')->name('register');
    Route::match(['GET', 'POST'], '/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'RafflesController@index');
    Route::get('/raffle/reload/list', 'RafflesController@reload');
    Route::resource('raffle', 'RafflesController');

    Route::get('/raffle-entries/{raffle_id}', 'RaffleEntriesController@get_raffle_entries');
});
