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
    }

    /**
     * Map the admin routes.
     */
    private function mapAdminRoutes()
    {
        $this->name('seo.')
             ->prefix($this->config()->get('arcanesoft.seo.route.prefix', 'seo'))
             ->group(function () {
                 Routes\Admin\SeoRoutes::register();
             });
    }
}
