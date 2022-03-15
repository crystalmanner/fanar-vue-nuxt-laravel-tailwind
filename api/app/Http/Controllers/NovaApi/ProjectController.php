<?php

namespace App\Http\Controllers\NovaApi;

use App\Http\Resources\API\ArticleResource;
use App\Http\Resources\API\ProjectResource;
use App\Models\Article;
use App\Models\Project;

class ProjectController extends \Laravel\Nova\Http\Controllers\ResourceShowController
{
    public function detail($lang, $slug)
    {
        app()->setLocale($lang);
        $resource = Project::where('slug', '=', $slug)->firstOrFail();
        return response(new ProjectResource($resource));
    }
}
