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

Route::group([ 'namespace'=> '\App\Http\Controllers\Api', 'prefix' => '',  'as'=>'', 'middleware' => ['auth:api']], function () { 
  Route::get('/products/search/{title}', 'ProductController@search')->name('products.search'); 
  Route::apiResource('products', 'ProductController'); 
});

Route::group([ 'namespace'=> '\App\Http\Controllers\Api\Admin', 'prefix' => 'admin',  'as'=>'admin.', 'middleware' => ['auth:api']], function () { 
  Route::get('/products/search/{title}', 'ProductController@search')->name('products.search'); 
  Route::apiResource('products', 'ProductController'); 
});

Route::group([ 'namespace'=> '\App\Http\Controllers\Api', 'prefix' => '',  'as'=>'', 'middleware' => ['auth:api']], function () { 
  Route::get('/projects/search/{title}', 'ProjectController@search')->name('projects.search'); 
  Route::apiResource('projects', 'ProjectController'); 
});

Route::group([ 'namespace'=> '\App\Http\Controllers\Api\Admin', 'prefix' => 'admin',  'as'=>'admin.', 'middleware' => ['auth:api']], function () { 
  Route::get('/projects/search/{title}', 'ProjectController@search')->name('projects.search'); 
  Route::apiResource('projects', 'ProjectController'); 
});