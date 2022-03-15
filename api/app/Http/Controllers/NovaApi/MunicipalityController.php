<?php

namespace App\Http\Controllers\NovaApi;

use App\Http\Resources\API\MunicipalityResource;
use App\Models\City;
use App\Models\Municipality;

class MunicipalityController extends \Laravel\Nova\Http\Controllers\ResourceShowController
{
    public function index($lang, City $city = null)
    {
        app()->setLocale($lang);
        if (!$city)
            $city = City::find(1);
        $result = Municipality::where('city_id', $city->id)->withCount('apartments')->get();
        //return $result;
        return MunicipalityResource::collection($result);
    }
}
