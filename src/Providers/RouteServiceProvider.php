<?php namespace Arcanesoft\Seo\Providers;

use Arcanesoft\Core\Bases\RouteServiceProvider as ServiceProvider;
use Arcanesoft\Seo\Http\Routes;
use Illuminate\Contracts\Routing\Registrar as Router;

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
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    public function map(Router $router)
    {
        $this->mapAdminRoutes($router);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Routes
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Map the admin routes.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    private function mapAdminRoutes(Router $router)
    {
        $attributes = $this->getAdminAttributes(
            'seo.',
            'Arcanesoft\\Seo\\Http\\Controllers\\Admin',
            $this->config()->get('arcanesoft.seo.route.prefix', 'seo')
        );

        $router->group($attributes, function ($router) {
            Routes\Admin\SeoRoutes::register($router);
        });
    }
}
