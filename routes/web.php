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

Route::get('/receipt', 'DashboardController@index')->name('receipt');
Route::post('/receipt/{receipt}', 'DashboardController@status')->name('receipt.status');
Route::delete('/receipt/{receipt}', 'DashboardController@destroy')->name('receipt.destroy');

Route::get('/mailable', function () {
    $data = App\Receipt::first();

    return new App\Mail\Code($data);
});

