<?php
namespace App\Http\Controllers\NovaApi;
use Laravel\Nova\Http\Requests\ResourceDetailRequest;
class ResourceShowController extends \Laravel\Nova\Http\Controllers\ResourceShowController
{
    public function handle(ResourceDetailRequest $request)
    {
        $lang = request('lang', request()->header('lang'));
        if ($lang) app()->setLocale($lang);
        $resource = $request->newResourceWith(tap($request->findModelQuery(), function ($query) use ($request) {
            $request->newResource()->detailQuery($request, $query);
        })->firstOrFail());
        $apiResource = $resource::$apiResource;
        return response(new $apiResource($resource));
    }
}