<?php

namespace App\Http\Controllers\NovaApi;

use App\Http\Resources\API\ApartmentResource;
use App\Models\Apartment;

class ApartmentController extends \Laravel\Nova\Http\Controllers\ResourceShowController
{
    public function detail($lang, $slug)
    {
        app()->setLocale($lang);
        $resource = Apartment::where('slug', $slug)->firstOrFail();
        $keywords = $resource->tags->pluck("id")->toArray();

        $resource->related = Apartment::with([
            "apartmentStatus",
            "project.municipality.city",
            "municipality.city"
        ])
            ->where('id', '!=', $resource->id)
            ->whereHas("tags", function ($q) use ($keywords) {
                $q->whereIn("apartment_tags.id", $keywords);
            })
            ->latest()
            ->limit(3)
            ->get();

        return response((new ApartmentResource($resource))->withSeo());
    }
}
