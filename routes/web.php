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

Route::get('/', "App\Http\Controllers\MitreController@index");
Route::get('tactic/{shortName}', "App\Http\Controllers\MitreController@tactic");
Route::get('technique/{id}', "App\Http\Controllers\MitreController@technique");
Route::post('technique/search', "App\Http\Controllers\MitreController@searchTechnique");
