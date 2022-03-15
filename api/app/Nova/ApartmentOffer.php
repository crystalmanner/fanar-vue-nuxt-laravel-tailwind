<?php

namespace App\Nova;

use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use MrMonat\Translatable\Translatable;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use App\Models\ApartmentOffer as ResourceModel;
use Laravel\Nova\Fields\Number;

class ApartmentOffer extends Resource
{
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
    ];

    public static $group = "Project Offer";

    public static $displayInNavigation = false;

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

            BelongsTo::make('Apartment')->rules("required"),

            Number::make('Age')
                ->rules("required", 'integer', 'min:0')
                ->hideFromIndex(),

            Number::make('Rooms')
                ->rules("required", 'integer', 'min:0')
                ->hideFromIndex(),

            Translatable::make("Rooms Categories")
                ->rules("nullable")
                ->hideFromIndex(),

            Number::make('Annual Expenses')
                ->rules("required", 'numeric', 'min:0')
                ->hideFromIndex(),

            Number::make('Expected Return Value')
                ->rules("required", 'numeric', 'min:0')
                ->hideFromIndex(),

            Number::make('Building Area')
                ->rules("required", 'numeric', 'min:0')
                ->step(0.01)
                ->hideFromIndex(),

            Translatable::make("Available Furniture")
                ->rules("nullable")
                ->hideFromIndex()
        ];
    }
}
