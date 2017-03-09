<?php namespace Arcanesoft\Seo\Http\Routes\Admin;

use Arcanedev\Support\Routing\RouteRegistrar;
use Arcanesoft\Seo\Models\Meta;

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
        $this->bind('seo_meta', function ($id) {
            return Meta::findOrFail($id);
        });

        $this->prefix('metas')->name('metas.')->group(function () {
            $this->get('/', 'MetasController@index')
                 ->name('index'); // admin::seo.metas.index

            $this->prefix('{seo_meta}')->group(function () {
                $this->get('/', 'MetasController@show')
                     ->name('show'); // admin::seo.metas.show
            });
        });
    }
}
