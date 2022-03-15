<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class Role extends \DigitalCloud\PermissionTool\Resources\Role
{
    use Authorizable;

    public static $resourcePermissions = [
        'viewAny',
        'view',
        'create',
        'delete',
        'update'
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        self::seed();

        return parent::indexQuery($request, $query);
    }

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make(__('PermissionTool::roles.name'), 'name')
                ->rules(['required', 'string', 'max:255'])
                ->creationRules('unique:' . config('permission.table_names.roles'))
                ->updateRules('unique:' . config('permission.table_names.roles') . ',name,{{resourceId}}'),

            \DigitalCloud\PermissionTool\Fields\Permission::make(__('PermissionTool::resources.Permissions'), 'permissions')->onlyOnForms(),
            Text::make('permissions count')->withMeta(['value' => count($this->permissions)])->exceptOnForms(),
            Text::make('users count')->withMeta(['value' => count($this->users)])->exceptOnForms(),
            DateTime::make(__('PermissionTool::roles.created_at'), 'created_at')->exceptOnForms(),
            DateTime::make(__('PermissionTool::roles.updated_at'), 'updated_at')->exceptOnForms(),
            BelongsToMany::make(__('PermissionTool::resources.Permissions'), 'permissions', Permission::class),
        ];
    }

    public function authorizedToDetach(NovaRequest $request, $model, $relationship)
    {
        if ($this->model()->id === 1) {
            return false;
        }

        return true;
    }

    public function authorizedToAttach(NovaRequest $request, $model)
    {
        return false;
    }

    public function authorizedToAttachAny(NovaRequest $request, $model)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        if (!parent::authorizedToDelete($request)) {
            return false;
        } else {
            if ($this->model()->id === 1 || count($this->users)) {
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
            if ($this->model()->id === 1) {
                return false;
            }
        }

        return true;
    }

    private static $generalPermissions = [
        "view settings",
        "view newsletter",
        "menu management",
        "language management",
    ];

    public static function seed()
    {
        foreach (Nova::$resources as $resource) {
            if ($resource == 'Laravel\Nova\Actions\ActionResource' || !isset($resource::$resourcePermissions)) {
                continue;
            }

            $resourcePermissions = $resource::$resourcePermissions;
            $resourceName = strtolower(substr(strrchr($resource, "\\"), 1));

            foreach ($resourcePermissions as $key => $resourcePermission) {
                if (is_int($key))
                    $resourcePermission .= " $resourceName";
                \DigitalCloud\PermissionTool\Models\Permission::firstOrCreate(
                    ['name' => $resourcePermission], ['guard_name' => config("nova.guard")]
                );
            }
        }

        foreach (self::$generalPermissions as $resourcePermission) {
            \DigitalCloud\PermissionTool\Models\Permission::firstOrCreate(
                ['name' => $resourcePermission], ['guard_name' => config("nova.guard")]
            );
        }

        $role = \Spatie\Permission\Models\Role::with("permissions")->firstOrCreate(["id" => 1], ["name" => "Admin"]);
        if ($role->permissions->count() < \Spatie\Permission\Models\Permission::count()) {
            $role->permissions()->attach(\Spatie\Permission\Models\Permission::whereNotIn("id", $role->permissions->pluck("id")->toArray())->pluck("id")->toArray());
        }

        if (($admin = \App\Models\Admin::find(1)) && !$admin->hasRole("Admin")) {
            $admin->assignRole('Admin');
        }
    }
}
