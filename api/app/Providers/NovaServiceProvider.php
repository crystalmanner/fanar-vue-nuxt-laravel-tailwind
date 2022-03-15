<?php

namespace App\Providers;

use App\Nova\Metrics\ApartmentOffers;
use App\Nova\Metrics\Apartments;
use App\Nova\Metrics\Articles;
use App\Nova\Metrics\Blog;
use App\Nova\Metrics\Calls;
use App\Nova\Metrics\News;
use App\Nova\Permission;
use App\Nova\Role;
use App\Models\Admin;
use Digitalcloud\MultilingualNova\NovaLanguageTool;
use Digitalcloud\NovaMailchimp\NovaMailchimp;
use DigitalCloud\PermissionTool\PermissionTool;
use DigitalCloud\Settings\Settings;
use Illuminate\Support\Facades\Auth;
use Infinety\Filemanager\FilemanagerTool;
use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::style('custom', public_path('css/custom.css'));
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            //->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, Admin::pluck('email')->toArray());
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new \Tightenco\NovaGoogleAnalytics\PageViewsMetric,
            new \Tightenco\NovaGoogleAnalytics\VisitorsMetric,
            new \Tightenco\NovaGoogleAnalytics\MostVisitedPagesCard,
            new Calls,
            new Articles,
            new Blog,
            new News,
            new Apartments,
            new ApartmentOffers
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {//
        return [
            \Whitecube\NovaPage\NovaPageTool::make(),
            (new \OptimistDigital\MenuBuilder\MenuBuilder([
                "locales" => [
                    "en" => 'English',
                    'ar' => 'Arabic'
                ]
            ]))
                ->canSee(function () {
                    return Auth::guard(config("nova.guard"))->check() && Auth::guard(config("nova.guard"))->user()->can("menu management");
                }),
            (new Settings())
                ->canSee(function () {
                    return Auth::guard(config("nova.guard"))->check() && Auth::guard(config("nova.guard"))->user()->can("view settings");
                }),
            (new NovaMailchimp())
                ->canSee(function () {
                    return Auth::guard(config("nova.guard"))->check() && Auth::guard(config("nova.guard"))->user()->can("view newsletter");
                }),

            (new NovaLanguageTool())
                ->canSee(function () {
                    return Auth::guard(config("nova.guard"))->check() && Auth::guard(config("nova.guard"))->user()->can("language management");
                }),

            new FilemanagerTool(),

            (new PermissionTool())
                ->canSee(function () {
                    return !Role::authorizable() || Role::authorizedToViewAny(request()) || Permission::authorizedToViewAny(request());
                })
                ->permissionResource(Permission::class)
                ->roleResource(Role::class),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
