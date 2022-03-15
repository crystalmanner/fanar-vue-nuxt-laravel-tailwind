<?php

namespace App\Nova;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Setting extends Resource
{
    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Setting';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'section', 'key'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        $result = [];
        foreach (\App\Models\Setting::all() as $setting) {
            if ($setting->type == 'AddressField')
                $result[] = (\config('settings.' . $setting->type))::make(str_replace("_", " ", Str::title($setting->key)), $setting->key)->withMeta(['value' => $setting->value, 'section' => $setting->section])->withLatLng()->withMap();
            else
                $result[] = (\config('settings.' . $setting->type))::make(str_replace("_", " ", Str::title($setting->key)), $setting->key)->withMeta(['value' => $setting->value, 'section' => $setting->section]);
        }
        return $result;
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
