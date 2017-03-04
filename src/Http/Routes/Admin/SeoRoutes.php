<?php namespace Arcanesoft\Seo\Http\Routes\Admin;

use Arcanedev\Support\Routing\RouteRegistrar;

/**
 * Class     SeoRoutes
 *
 * @package  Arcanesoft\Seo\Http\Routes\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Map routes.
     */
    public function map()
    {
        $this->prefix('stats')->name('stats.')->group(function () {
            $this->get('/', 'DashboardController@index')
                 ->name('index'); // admin::seo.stats.index
        });

        $this->prefix('metas')->name('metas.')->group(function () {
            $this->get('/', 'MetasController@index')
                 ->name('index'); // admin::seo.metas.index
        });

        $this->prefix('spammers')->name('spammers.')->group(function () {
            $this->get('/', 'SpammersController@index')
                 ->name('index'); // admin::seo.spammers.index
        });
    }
}
