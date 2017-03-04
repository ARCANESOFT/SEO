<?php namespace Arcanesoft\Seo\Http\Routes\Admin;

use Arcanedev\Support\Routing\RouteRegistrar;

/**
 * Class     MetasRoutes
 *
 * @package  Arcanesoft\Seo\Http\Routes\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetasRoutes extends RouteRegistrar
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
        $this->prefix('metas')->name('metas.')->group(function () {
            $this->get('/', 'MetasController@index')
                 ->name('index'); // admin::seo.metas.index
        });
    }
}
