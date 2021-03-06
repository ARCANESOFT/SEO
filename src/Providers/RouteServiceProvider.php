<?php namespace Arcanesoft\Seo\Providers;

use Arcanesoft\Core\Bases\RouteServiceProvider as ServiceProvider;
use Arcanesoft\Seo\Http\Routes;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanesoft\Seo\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The admin controller namespace for the application.
     *
     * @var string
     */
    protected $adminNamespace = 'Arcanesoft\\Seo\\Http\\Controllers\\Admin';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->adminGroup(function () {
            $this->mapAdminRoutes();
        });

        $this->mapPublicRoutes();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the route bindings.
     */
    protected function registerRouteBindings()
    {
        Routes\Admin\PagesRoutes::bindings();
        Routes\Admin\FootersRoutes::bindings();
        Routes\Admin\MetasRoutes::bindings();
        Routes\Admin\RedirectsRoutes::bindings();
    }

    /**
     * Map the admin routes.
     */
    protected function mapAdminRoutes()
    {
        $this->name('seo.')
             ->prefix($this->config()->get('arcanesoft.seo.route.prefix', 'seo'))
             ->group(function () {
                 Routes\Admin\DashboardRoutes::register();
                 Routes\Admin\PagesRoutes::register();
                 Routes\Admin\FootersRoutes::register();
                 Routes\Admin\MetasRoutes::register();
                 Routes\Admin\RedirectsRoutes::register();
                 Routes\Admin\SpammersRoutes::register();
                 Routes\Admin\SettingsRoutes::register();
             });
    }

    /**
     * Map the public routes.
     */
    protected function mapPublicRoutes()
    {
        Routes\Front\FootersRoutes::register();
    }
}
