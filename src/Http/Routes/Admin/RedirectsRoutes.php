<?php namespace Arcanesoft\Seo\Http\Routes\Admin;

use Arcanedev\Support\Routing\RouteRegistrar;

/**
 * Class     RedirectsRoutes
 *
 * @package  Arcanesoft\Seo\Http\Routes\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RedirectsRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->prefix('redirects')->name('redirects.')->group(function () {
            $this->get('/', 'RedirectsController@index')
                 ->name('index'); // admin::seo.redirects.index

            $this->get('create', 'RedirectsController@create')
                 ->name('create'); // admin::seo.redirects.create

            $this->post('store', 'RedirectsController@store')
                 ->name('store'); // admin::seo.redirects.store
        });
    }
}
