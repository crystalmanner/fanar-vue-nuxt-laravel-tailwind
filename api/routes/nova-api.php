<?php
Route::middleware(['nova-api'])->group(function () {
//    Route::post('/{resource}', 'ResourceStoreController@handle');
    Route::put('/{resource}/restore', 'ResourceRestoreController@handle');
    Route::put('/{resource}/{resourceId}', 'ResourceUpdateController@handle');
    Route::delete('/{resource}', 'ResourceDestroyController@handle');
    Route::delete('/{resource}/force', 'ResourceForceDeleteController@handle');
    Route::delete('/{resource}/detach', 'ResourceDetachController@handle');
    // Associatable Resources...
    Route::get('/{resource}/associatable/{field}', 'AssociatableController@index');
    Route::get('/{resource}/{resourceId}/attachable/{field}', 'AttachableController@index');
    Route::get('/{resource}/morphable/{field}', 'MorphableController@index');
////////////////////////////////////////////////////////////////////////////////////////
//////////                       not tested                         ////////////////////
///////////////////////////////////////////////////////////////////////////////////////
// Resource Attachment...
    Route::post('/{resource}/{resourceId}/attach/{relatedResource}', 'ResourceAttachController@handle');
    Route::post('/{resource}/{resourceId}/update-attached/{relatedResource}/{relatedResourceId}', 'AttachedResourceUpdateController@handle');
    Route::post('/{resource}/{resourceId}/attach-morphed/{relatedResource}', 'MorphedResourceAttachController@handle');
// Actions...
    Route::get('/{resource}/actions', 'ActionController@index');
    Route::post('/{resource}/action', 'ActionController@store');
// Filters...
    Route::get('/{resource}/filters', 'FilterController@index');
// Lenses...
    Route::get('/{resource}/lenses', 'LensController@index');
    Route::get('/{resource}/lens/{lens}', 'LensController@show');
    Route::get('/{resource}/lens/{lens}/count', 'LensResourceCountController@show');
    Route::delete('/{resource}/lens/{lens}', 'LensResourceDestroyController@handle');
    Route::delete('/{resource}/lens/{lens}/force', 'LensResourceForceDeleteController@handle');
    Route::put('/{resource}/lens/{lens}/restore', 'LensResourceRestoreController@handle');
    Route::post('/{resource}/lens/{lens}/action', 'LensActionController@store');
    Route::get('/{resource}/lens/{lens}/filters', 'LensFilterController@index');
// Cards / Metrics...
    Route::get('/metrics', 'DashboardMetricController@index');
    Route::get('/metrics/{metric}', 'DashboardMetricController@show');
    Route::get('/{resource}/metrics', 'MetricController@index');
    Route::get('/{resource}/metrics/{metric}', 'MetricController@show');
    Route::get('/{resource}/{resourceId}/metrics/{metric}', 'DetailMetricController@show');
    Route::get('/cards', 'DashboardCardController@index');
    Route::get('/{resource}/cards', 'CardController@index');
});
// Resource Management...
Route::namespace('\App\Http\Controllers\NovaApi')->group(function () {
    Route::get('/{lang}/page/{slug}/', 'PageController@detail');
    Route::get('/{lang}/articles/{slug}/', 'ArticleController@detail');
    Route::get('/{lang}/apartments/{slug}/', 'ApartmentController@detail');
    Route::get('/settings/', 'SettingsIndexController@handle');
    Route::get('/campaigns', 'CampaignController@index');
    Route::get('{lang}/menu/', 'MenuController@index');
    Route::get('{lang}/tags/articles/{tag}', 'ArticleController@index');
    Route::get('{lang}/municipalities/{city?}', 'MunicipalityController@index');
    Route::get('/{lang}/{resource}', 'ResourceIndexController@handle');
    Route::get('/{lang}/{resource}/{resourceId}', 'ResourceShowController@handle');
});

// Global Search...
Route::get('/search', 'SearchController@index');
Route::get('/{resource}/count', 'ResourceCountController@show');
