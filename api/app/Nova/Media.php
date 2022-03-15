<?php

namespace App\Nova;

use App\Nova\Actions\AddMediaMeta;
use Inspheric\Fields\Url;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use App\Models\Media as ResourceModel;
use MrMonat\Translatable\Translatable;

class Media extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = ResourceModel::class;

    public static $displayInNavigation = false;
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'file_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
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
            ID::make(),
            Image::make("image", "file_name")->displayUsing(function ($value) {
                return $this->resource->getItemPath();
            }),
            Translatable::make('Title')->singleLine()
                ->rules('nullable', 'max:254'),
            Text::make('Disk')->exceptOnForms()->sortable(),
            Url::make('Download Url', 'file_name')->displayUsing(function () {
                return $this->resource->getFullUrl();
            })->clickable()->sortable()->clickableOnIndex()->exceptOnForms(),
            Text::make('Size')->displayUsing(function () {
                return $this->resource->getHumanReadableSizeAttribute();
            })->exceptOnForms()->sortable(),
            Text::make('Updated At')->displayUsing(function () {
                return $this->resource->updated_at->diffForHumans();
            })->exceptOnForms()->sortable(),
        ];
    }

    public function actions(Request $request)
    {
        return [(new AddMediaMeta())->canRun(function () {
            return true;
        })];
    }

    public static function authorizeToCreate(Request $request)
    {
        return false;
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizeToUpdate(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }
}
