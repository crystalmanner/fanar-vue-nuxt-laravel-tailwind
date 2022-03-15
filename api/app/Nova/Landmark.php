<?php

namespace App\Nova;

use App\Http\Resources\API\LandMarkResource;
use DigitalCloud\MultiSelectField\MultiSelectField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use App\Models\Landmark as ResourceModel;
use MrMonat\Translatable\Translatable;

class Landmark extends Resource
{
    use Authorizable;

    public static $with = ['landmarkType', 'municipalities'];
    public static $apiResource = LandMarkResource::class;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ResourceModel::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name'
    ];

    public static $group = "Locations";

    public static $resourcePermissions = [
        'viewAny',
        'view',
        'create',
        'update',
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

            Translatable::make('Name')->singleLine()
                ->rules('required', 'max:254'),

            BelongsTo::make('Type', "landmarkType", LandmarkType::class)->rules('required'),

            DateTime::make('Created At')
                ->exceptOnForms(),

            MultiSelectField::make("Municipalities")
                ->relation("municipalities")
                ->rules("required", "array")
                ->options(\App\Models\Municipality::pluck('name', 'id')->toArray()),
        ];
    }
}
