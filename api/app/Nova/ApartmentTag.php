<?php

namespace App\Nova;

use App\Http\Resources\API\ApartmentTagResource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use App\Models\ApartmentTag as ResourceModel;
use MrMonat\Translatable\Translatable;

class ApartmentTag extends Resource
{
    use Authorizable;
    public static $apiResource = ApartmentTagResource::class;


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
        return 'Tags';
    }

    public static function singularLabel()
    {
        return 'Tag';
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
        ];
    }
}
