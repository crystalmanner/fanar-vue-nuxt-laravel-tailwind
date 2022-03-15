<?php

namespace App\Nova;

use App\Nova\Filters\CountryFilter;
use App\Nova\Filters\FromDateFilter;
use App\Nova\Filters\ToDateFilter;
use Inspheric\Fields\Url;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Call extends Resource
{
    use Authorizable;

    public static $with = ['country'];
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Call::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'mobile';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'email', 'mobile', 'name'
    ];

    public static $resourcePermissions = [
        'viewAny',
        'view',
        'delete'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Mobile', function () {
                return $this->resource->code . $this->resource->mobile;
            }),

            BelongsTo::make("Country"),

            Text::make('Name')->onlyOnDetail(),

            Text::make('Email')->onlyOnDetail(),

            Textarea::make("Message")->onlyOnDetail(),

            Url::make("Page")->displayUsing(function () {
                return $this->model()->page ? config('app.website') . $this->model()->page : "";
            })->alwaysClickable(),
            DateTime::make("Date", "created_at")
        ];
    }

    public function filters(Request $request)
    {
        return [
            new CountryFilter(),
            new FromDateFilter(),
            new ToDateFilter()
        ];
    }
}
