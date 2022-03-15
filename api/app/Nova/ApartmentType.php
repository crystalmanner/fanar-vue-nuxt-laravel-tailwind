<?php

namespace App\Nova;

use App\Http\Resources\API\ApartmentTypeResource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use App\Models\ApartmentType as ResourceModel;
use MrMonat\Translatable\Translatable;

class ApartmentType extends Resource
{
    use Authorizable;

    public static $apiResource = ApartmentTypeResource::class;

    public static $resourcePermissions = [
        'viewAny',
        'view',
        'create',
        'update',
        'delete'
    ];
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
        return 'Types';
    }

    public static function singularLabel()
    {
        return 'Type';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name'
    ];

    public static $group = "Apartments";

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
        ];
    }
}
