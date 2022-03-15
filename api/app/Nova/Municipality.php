<?php

namespace App\Nova;

use App\Http\Resources\API\MunicipalityResource;
use App\Rules\CheckImage;
use DigitalCloud\MultiSelectField\MultiSelectField;
use Infinety\Filemanager\FilemanagerField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use App\Models\Municipality as ResourceModel;
use MrMonat\Translatable\Translatable;

class Municipality extends Resource
{
    use Authorizable;

    public static $with = ['city', 'landmarks'];
    public static $apiResource = MunicipalityResource::class;

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

            BelongsTo::make('City')->rules('required'),

            DateTime::make('Created At')
                ->exceptOnForms(),

            FilemanagerField::make('Image')
                ->rules("required", new CheckImage(4))
                ->folder("municipalities")
                ->displayAsImage(),

            MultiSelectField::make("Landmarks")
                ->relation("landmarks")
                ->rules("nullable", "array")
                ->options(\App\Models\Landmark::pluck('name', 'id')->toArray()),
        ];
    }
}
