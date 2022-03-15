<?php

namespace App\Http\Controllers\NovaApi;

use App\Http\Resources\API\ArticleResource;
use App\Models\Article;

class ArticleController extends \Laravel\Nova\Http\Controllers\ResourceShowController
{
    public function index($lang, $tag)
    {
        app()->setLocale($lang);
        $related = Article::where("keywords", 'like', "%" . $tag . "%")->paginate();

        return response(ArticleResource::collection($related));
    }

    public function detail($lang, $slug)
    {
        app()->setLocale($lang);
        $resource = Article::where('slug', '=', $slug)->firstOrFail();
        $keywords = explode(",", $resource->keywords);
        $related = Article::whereType($resource->type)
            ->where('id', '!=', $resource->id)
            ->where(function ($q) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $q->orWhere("keywords", 'like', "%" . $keyword . "%");
                }
            });

        $resource->related = $related->latest()->limit(3)->get();
        return response((new ArticleResource($resource))->withSeo());
    }
}
