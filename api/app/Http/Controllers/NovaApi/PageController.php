<?php

namespace App\Http\Controllers\NovaApi;

use App\Http\Resources\API\PageResource;
use App\Http\Resources\API\StaticPageResource;
use App\Models\StaticPage;
use Whitecube\NovaPage\Pages\Manager;

class PageController extends \Laravel\Nova\Http\Controllers\ResourceShowController
{
    public function detail($lang, $slug)
    {
        StaticPage::where('name', $slug)->firstOrFail();

        $template = resolve(Manager::class)->load($slug);
        app()->setLocale($lang);
        return new StaticPageResource($template);
    }
}
