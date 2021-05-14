<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Routes;

use Arcanesoft\Seo\Http\Controllers\FootersController;

/**
 * Class     FootersRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FootersRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const ROUTE_INDEX = 'admin::seo.footers.index';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->adminGroup(function (): void {
            $this->prefix('footers')->name('footers.')->group(function (): void {
                // admin::seo.pages.index
                $this->get('/', [FootersController::class, 'index'])
                     ->name('index');
            });
        });
    }
}
