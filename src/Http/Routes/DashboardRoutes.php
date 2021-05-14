<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Routes;

use Arcanesoft\Seo\Http\Controllers\DashboardController;

/**
 * Class     DashboardRoutes
 *
 * @package  Arcanesoft\Seo\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const ROUTE_INDEX = 'admin::seo.index';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->adminGroup(function () {
            $this->get('/', [DashboardController::class, 'index'])
                 ->name('index'); // admin::seo.index
        });
    }
}
