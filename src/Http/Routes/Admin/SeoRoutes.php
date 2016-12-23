<?php namespace Arcanesoft\Seo\Http\Routes\Admin;

use Arcanedev\Support\Bases\RouteRegister;
use Illuminate\Contracts\Routing\Registrar;

/**
 * Class     SeoRoutes
 *
 * @package  Arcanesoft\Seo\Http\Routes\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoRoutes extends RouteRegister
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Map routes.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $this->group(['prefix' => 'stats', 'as' => 'stats.'], function () {
            $this->get('/', 'DashboardController@index')->name('index'); // admin::seo.stats.index
        });

        $this->group(['prefix' => 'metas', 'as' => 'metas.'], function () {
            $this->get('/', 'MetasController@index')->name('index'); // admin::seo.metas.index
        });

        $this->group(['prefix' => 'spammers', 'as' => 'spammers.'], function () {
            $this->get('/', 'SpammersController@index')->name('index'); // admin::seo.spammers.index
        });
    }
}
