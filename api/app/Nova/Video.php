<?php

namespace App\Nova;

use App\Http\Resources\API\VideoResource;
use App\Nova\Filters\FromDateFilter;
use App\Nova\Filters\StatusFilter;
use App\Nova\Filters\ToDateFilter;
use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use App\Models\Video as ResourceModel;
use Media24si\NovaYoutubeField\Youtube;
use MrMonat\Translatable\Translatable;

class Video extends Resource
{
    use Authorizable;

    public static $model = ResourceModel::class;

    public static $apiResource = VideoResource::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title->en';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title', 'status'
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

            Translatable::make('Title')->singleLine()
                ->rules('required', 'max:254')->sortable(false),

            Youtube::make('Video', 'video_id')
                ->help("select the last segment of the youtube url like 'HwyheOVNuTc' in  'https://www.youtube.com/watch?v=HwyheOVNuTc'")
                ->rules("required"),

            Toggle::make('Status')
                ->rules("required")
                ->values(self::$model::STATUS_ACTIVE, self::$model::STATUS_NOT_ACTIVE),
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
