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

Route::apiResource("/users", "Api\UserController");

#region Admin
    
Route::group(["prefix" => "admin", "namespace" => "Api\Admin", "as" => "admin."], function() {
    Route::apiResource("/users", "UserController");
});
    
#endregion
