<?php

namespace App\Nova;

use App\Http\Resources\API\PopupResource;
use App\Nova\Filters\StatusFilter;
use App\Nova\Filters\FromDateFilter;
use App\Nova\Filters\ToDateFilter;
use App\Rules\CheckImage;
use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Infinety\Filemanager\FilemanagerField;
use Laravel\Nova\Fields\ID;
use App\Models\Popup as ResourceModel;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class Popup extends Resource
{
    use Authorizable;

    public static $model = ResourceModel::class;
    public static $apiResource = PopupResource::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title', 'page', 'link', 'seconds', 'status'
    ];

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

            Text::make('Title')
                ->rules("required")
                ->help("for internal use")
                ->sortable(),

            Select::make('Page')
                ->rules("required")
                ->options(array_flip(self::$model::PAGES))
                ->sortable(),

            Number::make("After Seconds", "seconds")
                ->rules("required", "integer", "min:0")
                ->sortable(),

            Text::make('Link')
                ->rules("nullable", "url")
                ->sortable(),

            Toggle::make('Status')
                ->rules("required")
                ->values(self::$model::STATUS_ACTIVE, self::$model::STATUS_NOT_ACTIVE)
                ->sortable(),

            FilemanagerField::make('Image')
                ->rules("required", new CheckImage(4))
                ->folder("popups")
                ->displayAsImage()
                ->hideFromIndex(),
        ];
    }

    public function filters(Request $request)
    {
        return [
            new StatusFilter(self::$model::STATUSES),
            new FromDateFilter(),
            new ToDateFilter()
        ];
    }
}
