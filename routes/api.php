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

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
  Route::post('register', 'AuthController@register');
  Route::post('login', 'AuthController@login');

  Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', 'AuthController@logout');
  });
});

//Backend (/admin prefix)
Route::group([ 'namespace'=> '\App\Http\Controllers\Api\Admin', 'prefix' => 'admin',  'as'=>'admin.', 'middleware' => ['auth:api']], function () { 
  Route::get('/products/search/{title}', 'ProductController@search')->name('products.search'); 
  Route::apiResource('products', 'ProductController'); 

  Route::get('/permissions/search/{name}', 'PermissionController@search')->name('permissions.search'); 
  Route::apiResource('permissions', 'PermissionController'); 

  Route::get('/roles/search/{name}', 'RoleController@search')->name('roles.search'); 
  Route::apiResource('roles', 'RoleController'); 

  Route::get('/users/search/{title}', 'UserController@search')->name('users.search'); 
  Route::apiResource('users', 'UserController'); 
});

//Frontend (no /admin prefix)
Route::group([ 'namespace'=> '\App\Http\Controllers\Api', 'prefix' => '',  'as'=>'', 'middleware' => ['auth:api']], function () { 
  Route::get('/products/search/{title}', 'ProductController@search')->name('products.search'); 
  Route::apiResource('products', 'ProductController'); 
});