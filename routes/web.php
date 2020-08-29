<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Product routes
Route::get('api/product','ProductController@search');
Route::get('api/product','ProductController@index');
Route::get('api/product/{id}','ProductController@show');
Route::get('api/product/slug/{slug}','ProductController@getProductBySlug');
Route::get('api/product/search/{search}','ProductController@getProductBySearch');
Route::post ('api/product/store','ProductController@store');

// Variant routes
Route::get('api/variant/{product_id}','VariantController@getVariantsOfProduct');