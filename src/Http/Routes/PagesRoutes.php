<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Routes;

use Arcanesoft\Seo\Http\Controllers\PagesController;
use Arcanesoft\Seo\Repositories\PagesRepository;

/**
 * Class     PagesRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PagesRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const ROUTE_INDEX     = 'admin::seo.pages.index';
    const ROUTE_METRICS   = 'admin::seo.pages.metrics';
    const ROUTE_DATATABLE = 'admin::seo.pages.datatable';
    const ROUTE_CREATE    = 'admin::seo.pages.create';
    const ROUTE_STORE     = 'admin::seo.pages.store';
    const ROUTE_SHOW      = 'admin::seo.pages.show';
    const ROUTE_EDIT      = 'admin::seo.pages.edit';
    const ROUTE_UPDATE    = 'admin::seo.pages.update';
    const ROUTE_DELETE    = 'admin::seo.pages.delete';

    const WILDCARD_PAGE = 'admin_seo_page';

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
            $this->prefix('pages')->name('pages.')->group(function (): void {
                // admin::seo.pages.index
                $this->get('/', [PagesController::class, 'index'])
                     ->name('index');

                // admin::seo.pages.datatable
                $this->post('datatable', [PagesController::class, 'datatable'])
                     ->middleware(['ajax'])
                     ->name('datatable');

                // admin::seo.pages.metrics
                $this->get('metrics', [PagesController::class, 'metrics'])
                     ->name('metrics');

                // admin::seo.pages.create
                $this->get('create', [PagesController::class, 'create'])
                     ->name('create');

                // admin::seo.pages.store
                $this->post('store', [PagesController::class, 'store'])
                     ->name('store');

                $this->prefix('{'.static::WILDCARD_PAGE.'}')->group(function (): void {
                    // admin::seo.pages.show
                    $this->get('show', [PagesController::class, 'show'])
                         ->name('show');

                    // admin::seo.pages.edit
                    $this->get('edit', [PagesController::class, 'edit'])
                         ->name('edit');

                    // admin::seo.pages.update
                    $this->put('update', [PagesController::class, 'update'])
                         ->name('update');

                    // admin::seo.pages.delete
                    $this->delete('delete', [PagesController::class, 'delete'])
                         ->middleware(['ajax'])
                         ->name('delete');
                });
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Seo\Repositories\PagesRepository  $repo
     */
    public function bindings(PagesRepository $repo): void
    {
        $this->bind(static::WILDCARD_PAGE, function (string $id) use ($repo) {
            return $repo->findOrFail($id);
        });
    }
}
