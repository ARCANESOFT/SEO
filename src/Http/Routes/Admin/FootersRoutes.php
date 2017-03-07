<?php namespace Arcanesoft\Seo\Http\Routes\Admin;

use Arcanedev\Support\Routing\RouteRegistrar;
use Arcanesoft\Seo\Models\Footer;

/**
 * Class     FootersRoutes
 *
 * @package  Arcanesoft\Seo\Http\Routes\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FootersRoutes extends RouteRegistrar
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
        $this->bind('seo_footer', function ($id) {
            return Footer::findOrFail($id);
        });

        $this->prefix('footers')->name('footers.')->group(function () {
            $this->get('/', 'FootersController@index')
                 ->name('index'); // admin::seo.footers.index

            $this->get('create', 'FootersController@create')
                 ->name('create'); // admin::seo.footers.create

            $this->post('store', 'FootersController@store')
                 ->name('store'); // admin::seo.footers.store

            $this->prefix('{seo_footer}')->group(function () {
                $this->get('/', 'FootersController@show')
                     ->name('show'); // admin::seo.footers.show

                $this->get('edit', 'FootersController@edit')
                     ->name('edit'); // admin::seo.footers.edit

                $this->put('update', 'FootersController@update')
                     ->name('update'); // admin::seo.footers.update

                $this->middleware('ajax')
                     ->delete('delete', 'FootersController@delete')
                     ->name('delete'); // admin::seo.footers.delete
            });
        });
    }
}
