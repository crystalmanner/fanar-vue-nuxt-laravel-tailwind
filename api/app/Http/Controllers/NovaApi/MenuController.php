<?php

namespace App\Http\Controllers\NovaApi;

use OptimistDigital\MenuBuilder\Models\Menu;

class MenuController extends \Laravel\Nova\Http\Controllers\ResourceShowController
{
    public function index($lang)
    {
        $result = Menu::where('locale', $lang)->with('rootMenuItems')->get();
        return response($result);
    }
}
