<?php namespace Arcanesoft\Seo\Http\Routes\Admin;

use Arcanedev\Support\Routing\RouteRegistrar;
use Arcanesoft\Seo\Models\Redirect;

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
     * Register the bindings.
     */
    public static function bindings()
    {
        $registrar = new static;

        $registrar->bind('seo_redirect', function ($id) {
            return Redirect::findOrFail($id);
        });
    }

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

            $this->prefix('{seo_redirect}')->group(function () {
                $this->get('/', 'RedirectsController@show')
                     ->name('show'); // admin::seo.redirects.show

                $this->get('edit', 'RedirectsController@edit')
                     ->name('edit'); // admin::seo.redirects.edit

                $this->put('update', 'RedirectsController@update')
                     ->name('update'); // admin::seo.redirects.update

                $this->delete('delete', 'RedirectsController@delete')
                     ->middleware('ajax')
                     ->name('delete'); // admin::seo.redirects.delete
            });
        });
    }
}
