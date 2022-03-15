<?php

namespace App\Nova;

use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use App\Models\Admin as ResourceModel;
use DigitalCloud\PermissionTool\Fields\Role;

class Admin extends Resource
{
    use Authorizable;

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
        'name', 'email', 'status'
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

            Gravatar::make()->hideFromDetail(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:admins,email')
                ->updateRules('unique:admins,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:6')
                ->updateRules('nullable', 'string', 'min:6'),

            Role::make('Roles')->rules("required")->canSee(function () use ($request) {
                if ($request->resourceId == 1) {
                    return false;
                }

                return true;
            }),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }


    public function authorizedToDelete(Request $request)
    {
        if (!parent::authorizedToDelete($request)) {
            return false;
        } else {
            if ($this->model()->id === 1 || $this->model()->id === Auth::id()) {
                return false;
            }
        }

        return true;
    }

    public function authorizedToUpdate(Request $request)
    {
        if (!parent::authorizedToUpdate($request)) {
            return false;
        } else {
            if ($this->model()->id === 1 && Auth::id() === 1) {
                return true;
            } elseif ($this->model()->id === 1 || $this->model()->id === Auth::id()) {
                return false;
            }
        }

        return true;
    }

    public static $resourcePermissions = [
        'viewAny',
        'view',
        'create',
        'update',
        'delete'
    ];
}
