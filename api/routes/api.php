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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('city/{city}/municipalities', function (\App\Models\City $city) {
    return $city->municipalities->map(function (\App\Models\Municipality $municipality) {
        return ['value' => $municipality->id, 'display' => $municipality->name];
    });
});
Route::get('landmark-types/{landmarkType}/landmarks', function (\App\Models\LandmarkType $landmarkType) {
    return $landmarkType->landmarks->map(function (\App\Models\Landmark $landmark) {
        return ['value' => $landmark->id, 'display' => $landmark->name];
    });
});

Route::get('municipality/{municipality}/landmarks', function (\App\Models\Municipality $municipality) {
    return $municipality->landmarks->map(function (\App\Models\Landmark $landmark) {
        return ['value' => $landmark->id, 'label' => $landmark->name];
    });
});


Route::post('newsletter', [\App\Http\Controllers\NewsletterController::class, 'store']);
Route::post('call', [\App\Http\Controllers\CallController::class, 'store']);
Route::get('currency', [\App\Http\Controllers\CurrencyController::class, 'index']);

Route::get('/about-me', 'AboutController@show')
    ->template(\App\Nova\Templates\About::class)
    ->name('about');

Route::get('/services', 'AboutController@show')
    ->template(\App\Nova\Templates\Services::class)
    ->name('services');

Route::get('/add-property', 'AboutController@show')
    ->template(\App\Nova\Templates\AddProperty::class)
    ->name('add-property');

Route::get('/agents', 'AboutController@show')
    ->template(\App\Nova\Templates\Agents::class)
    ->name('agents');

Route::get('/blog', 'AboutController@show')
    ->template(\App\Nova\Templates\Blog::class)
    ->name('blog');

Route::get('/contact-us', 'AboutController@show')
    ->template(\App\Nova\Templates\ContactUs::class)
    ->name('contact-us');

Route::get('/featured', 'AboutController@show')
    ->template(\App\Nova\Templates\Featured::class)
    ->name('featured');

Route::get('/home', 'AboutController@show')
    ->template(\App\Nova\Templates\Home::class)
    ->name('home');

Route::get('/join-us', 'AboutController@show')
    ->template(\App\Nova\Templates\JoinUs::class)
    ->name('join-us');

Route::get('/properties', 'AboutController@show')
    ->template(\App\Nova\Templates\Properties::class)
    ->name('properties');
