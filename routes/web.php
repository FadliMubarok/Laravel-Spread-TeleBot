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
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
	// $activity = Telegram::getUpdates();
 //    dd(json_encode($activity));
    return view('welcome');
});

Route::post('/post-spreadsheet', 'SpreadSheetController@store')->name('kirim.spreadsheet');
