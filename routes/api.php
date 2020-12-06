<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('country/radio-list', 'Api\RadioController@radioListCountryWise');

Route::get('category/radio-list', 'Api\RadioController@radioListCategoryWise');

Route::get('radio-list', 'Api\RadioController@radioList');

Route::get('radio/count/store', 'Api\CountController@store');

Route::get('launcher', 'Api\LauncherController@index');

Route::get('new-launcher', 'Api\LauncherController@newLanuncher');

// Streaming issue report
Route::post('/streaming/issue/report/store', 'Api\StreamingReportController@store');
	
    
// feedback
Route::get('/feedback/type', 'Api\FeedbackController@feedBackType');

Route::get('/feedback/{id}/edit', 'Api\FeedbackController@edit');

Route::post('/feedback/store', 'Api\FeedbackController@store');

Route::post('/feedback/{id}/update', 'Api\FeedbackController@update');

Route::get('/category-list', 'Api\LauncherController@categoryList');
