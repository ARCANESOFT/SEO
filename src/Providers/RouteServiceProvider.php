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
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapAdminRoutes();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Routes
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Map the admin routes.
     */
    private function mapAdminRoutes()
    {
        $attributes = $this->getAdminAttributes(
            'seo.',
            'Arcanesoft\\Seo\\Http\\Controllers\\Admin',
            $this->config()->get('arcanesoft.seo.route.prefix', 'seo')
        );

        $this->group($attributes, function () {
            Routes\Admin\SeoRoutes::register();
        });
    }
}
