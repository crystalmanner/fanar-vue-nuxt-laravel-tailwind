<?php

namespace App\Http\Controllers\NovaApi;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Http\Requests\ResourceIndexRequest;

class SettingsIndexController extends \Laravel\Nova\Http\Controllers\ResourceIndexController
{
    public function handle(ResourceIndexRequest $request)
    {
        $request->route()->setParameter('resource', 'settings');
        $lang = request('lang', request()->header('lang'));

        if ($lang) app()->setLocale($lang);

        $paginator = $this->paginator(
            $request, $resource = $request->resource()
        );

        return response()->json([
            'label' => $resource::label(),
            'settings' => Setting::pluck('value', 'key')->map(function ($item, $index) {
                if (strpos($index, 'image') && $item && $index !== "slider_image") {
                    return Storage::url($item);
                }

                return $item;
            }),
            'prev_page_url' => $paginator->previousPageUrl(),
            'next_page_url' => $paginator->nextPageUrl(),
            'softDeletes' => $resource::softDeletes(),
        ]);
    }
}
