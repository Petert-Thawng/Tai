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
     return view('login');
 });
// Route::get('/test_chart', function () {
//     return view('test_chart_2');
// });
 Route::post('facebook_login','AccountController@check_user');
Route::get('show_api/{coin_symbol}','ApiController@get_api');

Route::get('trade/{coin_symbol}','ApiController@go_trade');

Route::get('account', 'ApiController@account');
Route::get('person_profile','AccountController@profile');

Route::get('transaction', 'ApiController@transaction');
Route::get('logout','AccountController@logout');

Route::post('buy','ApiController@buy');