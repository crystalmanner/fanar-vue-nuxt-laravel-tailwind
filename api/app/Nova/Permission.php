<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Permission extends \DigitalCloud\PermissionTool\Resources\Permission
{
    use Authorizable;

    public static $resourcePermissions = [
        'viewAny',
        'view'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make(__('PermissionTool::permissions.name'), 'name')
                ->rules(['required', 'string', 'max:255'])
                ->creationRules('unique:' . config('permission.table_names.permissions'))
                ->updateRules('unique:' . config('permission.table_names.permissions') . ',name,{{resourceId}}'),
            Text::make(__('PermissionTool::permissions.display_name'), function () {
                return __('PermissionTool::permissions.display_names.' . $this->name);
            })->canSee(function () {
                return is_array(__('PermissionTool::permissions.display_names'));
            }),
            DateTime::make(__('PermissionTool::permissions.created_at'), 'created_at')->exceptOnForms(),
            DateTime::make(__('PermissionTool::permissions.updated_at'), 'updated_at')->exceptOnForms(),
            BelongsToMany::make(__('PermissionTool::resources.Roles'), 'roles', Role::class)->searchable(),
        ];
    }

}
