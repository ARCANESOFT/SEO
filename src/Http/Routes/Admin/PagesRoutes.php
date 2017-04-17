<?php namespace Arcanesoft\Seo\Http\Routes\Admin;

use Arcanedev\Support\Routing\RouteRegistrar;
use Arcanesoft\Seo\Models\Page;

/**
 * Class     PagesRoutes
 *
 * @package  Arcanesoft\Seo\Http\Routes\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PagesRoutes extends RouteRegistrar
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

        $registrar->bind('seo_page', function ($id) {
            return Page::findOrFail($id);
        });
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->prefix('pages')->name('pages.')->group(function () {
            $this->get('/', 'PagesController@index')
                 ->name('index'); // admin::seo.pages.index

            $this->get('create', 'PagesController@create')
                 ->name('create'); // admin::seo.pages.create

            $this->post('store', 'PagesController@store')
                 ->name('store'); // admin::seo.pages.store

            $this->prefix('{seo_page}')->group(function () {
                $this->get('/', 'PagesController@show')
                     ->name('show'); // admin::seo.pages.show

                $this->get('edit', 'PagesController@edit')
                     ->name('edit'); // admin::seo.pages.edit

                $this->put('update', 'PagesController@update')
                     ->name('update'); // admin::seo.pages.update

                $this->delete('delete', 'PagesController@delete')
                     ->middleware('ajax')
                     ->name('delete'); // admin::seo.pages.delete
            });
        });
    }
}
