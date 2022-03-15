<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

trait Authorizable
{
    public static function authorizedToViewAny(Request $request)
    {
        if (!static::authorizable())
            return true;

        return self::hasPermission("viewAny") ? $request->user()->can(self::getPermission("viewAny")) : false;
    }

    public static function authorizedToCreate(Request $request)
    {
        if (!static::authorizable())
            return true;

        return self::hasPermission("create") ? $request->user()->can(self::getPermission("create")) : false;
    }

    public static function authorizable()
    { 
        if (!Auth::id())
            return false;

        if (!isset(self::$resourcePermissions) || !self::$resourcePermissions)
            return false;

        return true;
    }

    public function authorizedTo(Request $request, $ability)
    {
        if (!static::authorizable())
            return true;

        if (self::hasPermission($ability) && $request->user()->can(self::getPermission($ability))) {
            return true;
        } else {
            return false;
        }
    }

    public function canSeeWhen($ability, $arguments = [])
    {
        $arguments = Arr::wrap($arguments);

        if (isset($arguments[0]) && $arguments[0] instanceof Resource) {
            $arguments[0] = $arguments[0]->resource;
        }

        return $this->canSee(function ($request) use ($ability, $arguments) {
            return $request->user()->can(self::getPermission($ability), $arguments);
        });
    }

    public static function getPermission($ability)
    {
        $resourceName = strtolower(substr(strrchr(self::class, "\\"), 1));
        $i = array_search($ability, self::$resourcePermissions);
        if ($i !== false) {
            return self::$resourcePermissions[$i] . " $resourceName";
        } else {
            throw new \Exception("$ability not defined in " . self::class);
        }
    }

    public static function hasPermission($ability)
    {
        return array_search($ability, self::$resourcePermissions) !== false;
    }
}
