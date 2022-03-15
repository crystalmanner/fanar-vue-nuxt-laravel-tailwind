<?php
namespace App\Http\Controllers\NovaApi;
use Laravel\Nova\Http\Requests\ResourceIndexRequest;
class ResourceIndexController extends \Laravel\Nova\Http\Controllers\ResourceIndexController
{
    public function handle(ResourceIndexRequest $request)
    {
        $lang = request('lang', request()->header('lang'));
        if ($lang) app()->setLocale($lang);
        $paginator = $this->paginator(
            $request, $resource = $request->resource()
        );
        return response()->json([
            'label' => $resource::label(),
            //'resources' => $paginator->getCollection()->mapInto($resource)->map->serializeForIndex($request),
            'resources' => ($resource::$apiResource)::collection($paginator->getCollection()),
            'prev_page_url' => $paginator->previousPageUrl(),
            'next_page_url' => $paginator->nextPageUrl(),
            'softDeletes' => $resource::softDeletes(),
        ]);
    }
}