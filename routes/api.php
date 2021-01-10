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

Route::prefix("mitre")->group(function($api) {
    $api->get("tactics/all", "App\Http\Controllers\ApiMitreController@allTactics");
    $api->get("techniques/all", "App\Http\Controllers\ApiMitreController@allTechinques");
    $api->get("techniques/{id}", "App\Http\Controllers\ApiMitreController@singleTechnique");
});
