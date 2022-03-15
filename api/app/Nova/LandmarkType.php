<?php

namespace App\Nova;

use App\Http\Resources\API\LandMarkTypeResource;
use Laravel\Nova\Fields\DateTime;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use App\Models\LandmarkType as ResourceModel;
use MrMonat\Translatable\Translatable;

class LandmarkType extends Resource
{
    use Authorizable;

    public static $apiResource = LandMarkTypeResource::class;
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

    public static function label()
    {
        return 'Landmark Types';
    }

    public static function singularLabel()
    {
        return 'Landmark Type';
    }
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
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Translatable::make('Name')->singleLine()
                ->rules('required', 'max:254'),

            DateTime::make('Created At')
                ->exceptOnForms(),

            HasMany::make("Landmarks")
        ];
    }
}
