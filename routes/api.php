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

Route::resource('category','CategoryController');
Route::resource('users','UserController');
Route::post('jwt/login','UserController@login');
Route::get('admin-dashboard/statistics', 'UserController@getStatist');

Route::get('owners', 'UserController@owners');
Route::delete('owner/{owner_id}', 'UserController@ownerDestroy');
Route::get('fetch_owner/{owner_id}', 'UserController@fetch_owner');
Route::get('countries', 'UserController@countries');







Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
