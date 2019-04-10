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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'ZmluvaController@index')->name('home')->middleware('auth');

Route::resource('produkt', 'ProduktController');
Route::resource('zmluva', 'ZmluvaController')->middleware('auth');

Route::get('/potvrdenie', 'ZmluvaController@potvrdenie_formular');
Route::get('/zmluva/{id}/potvrd', 'ZmluvaController@potvrd');
Route::get('/zmluva/{id}/zdovodnenie', 'ZmluvaController@zdovodnenie');
Route::post('/zmluva/{id}/zamietni', 'ZmluvaController@zamietni');

Route::get('/novyprodukt', function () {
    return view('biznis.produkty');
});
