<?php

namespace DigitalCloud\Settings;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class Settings extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('settings', __DIR__.'/../dist/js/tool.js');
        Nova::style('settings', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('settings::navigation');
    }
}
