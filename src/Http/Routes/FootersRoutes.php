<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Routes;

use Arcanesoft\Seo\Http\Controllers\FootersController;
use Arcanesoft\Seo\Repositories\FootersRepository;

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

    const ROUTE_INDEX     = 'admin::seo.footers.index';
    const ROUTE_METRICS   = 'admin::seo.footers.metrics';
    const ROUTE_DATATABLE = 'admin::seo.footers.datatable';
    const ROUTE_CREATE    = 'admin::seo.footers.create';
    const ROUTE_STORE     = 'admin::seo.footers.store';
    const ROUTE_SHOW      = 'admin::seo.footers.show';
    const ROUTE_EDIT      = 'admin::seo.footers.edit';
    const ROUTE_UPDATE    = 'admin::seo.footers.update';
    const ROUTE_DELETE    = 'admin::seo.footers.delete';

    const WILDCARD_PAGE = 'admin_seo_footer';

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
                // admin::seo.footers.index
                $this->get('/', [FootersController::class, 'index'])
                     ->name('index');

                // admin::seo.footers.datatable
                $this->post('datatable', [FootersController::class, 'datatable'])
                     ->middleware(['ajax'])
                     ->name('datatable');

                // admin::seo.footers.metrics
                $this->get('metrics', [FootersController::class, 'metrics'])
                     ->name('metrics');

                // admin::seo.footers.create
                $this->get('create', [FootersController::class, 'create'])
                     ->name('create');

                // admin::seo.footers.store
                $this->post('store', [FootersController::class, 'store'])
                     ->name('store');

                $this->prefix('{'.static::WILDCARD_PAGE.'}')->group(function (): void {
                    // admin::seo.footers.show
                    $this->get('show', [FootersController::class, 'show'])
                         ->name('show');

                    // admin::seo.footers.edit
                    $this->get('edit', [FootersController::class, 'edit'])
                         ->name('edit');

                    // admin::seo.footers.update
                    $this->put('update', [FootersController::class, 'update'])
                         ->name('update');

                    // admin::seo.footers.delete
                    $this->delete('delete', [FootersController::class, 'delete'])
                         ->middleware(['ajax'])
                         ->name('delete');
                });
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Seo\Repositories\FootersRepository  $repo
     */
    public function bindings(FootersRepository $repo): void
    {
        $this->bind(static::WILDCARD_PAGE, function (string $id) use ($repo) {
            return $repo->findOrFail($id);
        });
    }
}
