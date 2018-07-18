<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login','Api\Login_api_Controller@check_user');

Route::get('/check_update','Api\Base_api_Controller@check_update');

// Route::group(['middleware' => 'check_session'], function () {
Route::get('/logout',"Api\Login_api_Controller@logout");
	//---------------------------------@author WaiYan-----------------------------------------
	Route::post('/rank','Api\Rank_api_Controller@ranking');
	Route::post('/current','Api\Rank_api_Controller@current_point');
	//----------------------------------------------------------------------------------------
	Route::post('/get_account_data','Api\Login_api_Controller@get_account_data');
	Route::post('/weekly','Api\Base_api_Controller@weekly');
	Route::get('/media_coin_get','Api\Media_api_Controller@get');
	Route::get('/media_coin_get_all','Api\Media_api_Controller@get_all');
	Route::get("/get_all_coins","Api\Coin_api_Controller@get_coin_list");
	Route::post("/buy","Api\Coin_api_Controller@buy");
	Route::post("/sell","Api\Coin_api_Controller@sell");
	Route::post("/get_daily_bonus","Api\Base_api_Controller@get_daily_bonus");
	Route::post("/get_video_bonus","Api\Base_api_Controller@get_video_bonus");
	Route::post("/check_daily_bonus","Api\Base_api_Controller@check_daily_bonus_api");
	Route::post("/get_coin_transaction_log","Api\Transaction_api_Controller@get_all_transaction");
	Route::post("/scan_qr",'Api\Login_api_Controller@scan_qr');

Route::post('/db/generate','Api\Login_api_Controller@generate_all_qrcodes');
// });
