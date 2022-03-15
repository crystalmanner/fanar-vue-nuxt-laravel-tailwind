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

Route::view('search', 'search');

Route::get('temp', function () {
    return new \App\Http\Resources\Algolia\ApartmentAlgoliaResource(\App\Models\Apartment::first());
});
