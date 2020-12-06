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


Route::get('/login', function () {
    return view('welcome');
})->name('login');


$adminGroup = [
    'prefix' => 'admin',
    "as" => "admin.",
    "namespace" => "Admin",
];

Route::get('/', 'Admin\DashboardController@admin');

Route::group($adminGroup, function () {

    Route::get('/login', 'AuthController@showLoginForm')->name('login');

    Route::post('/login', 'AuthController@login')->name('login-submit');

    
    Route::group(["middleware" => "auth:admin"], function () {

        Route::post('/logout', 'AuthController@logout')->name('logout');

        Route::get('/', 'DashboardController@admin');

        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        
        Route::resource('radio', 'RadioController');

        Route::get('mostly/played/radio-list', 'RadioController@mostlyPlayed')
            ->name('mostly-played.index');
        
        Route::get('mostly/played/radio/{id}/show', 'RadioController@mostlyPlayedShow')
            ->name('mostly-played.show');



        Route::resource('genres', 'GenresController');

        Route::resource('country', 'CountryController');

        Route::resource('notification', 'NotificationController');

        Route::resource('language', 'LanguageController');

        Route::resource('feedback', 'FeedbackController');
        
        Route::get('streaming/report', 'ReportController@index')
            ->name('report.index');

        Route::delete('streaming/report/{id}', 'ReportController@destroy')
            ->name('streaming-report.destroy');


    });


});
