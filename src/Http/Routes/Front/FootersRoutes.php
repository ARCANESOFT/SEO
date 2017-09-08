<?php namespace Arcanesoft\Seo\Http\Routes\Front;

use Arcanedev\Support\Routing\RouteRegistrar;
use Arcanesoft\Seo\Models\Footer;

/**
 * Class     FootersRoutes
 *
 * @package  Arcanesoft\Seo\Http\Routes\Front
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
        $this->bind('seo_footer_uri', function ($uri) {
            return Footer::query()
                ->where('uri', $uri)
                ->where('locale', config('app.locale'))
                ->firstOrFail();
        });

        $this->group(config('arcanesoft.seo.widgets.footers.route', []), function () {
            $this->get('{seo_footer_uri}.html', 'FootersController@show')->name('show');
        });
    }
}
