<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Routes;

use Arcanesoft\Seo\Http\Controllers\MetasController;
use Arcanesoft\Seo\Repositories\MetasRepository;

/**
 * Class     MetasRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetasRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const ROUTE_INDEX     = 'admin::seo.metas.index';
    const ROUTE_METRICS   = 'admin::seo.metas.metrics';
    const ROUTE_DATATABLE = 'admin::seo.metas.datatable';
    const ROUTE_SHOW      = 'admin::seo.metas.show';
    const ROUTE_EDIT      = 'admin::seo.metas.edit';
    const ROUTE_UPDATE    = 'admin::seo.metas.update';

    const WILDCARD_PAGE = 'admin_seo_meta';

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
            $this->prefix('metas')->name('metas.')->group(function (): void {
                // admin::seo.metas.index
                $this->get('/', [MetasController::class, 'index'])
                     ->name('index');

                // admin::seo.metas.datatable
                $this->post('datatable', [MetasController::class, 'datatable'])
                     ->middleware(['ajax'])
                     ->name('datatable');

                // admin::seo.metas.metrics
                $this->get('metrics', [MetasController::class, 'metrics'])
                     ->name('metrics');

                $this->prefix('{' . static::WILDCARD_PAGE . '}')->group(function (): void {
                    // admin::seo.metas.show
                    $this->get('show', [MetasController::class, 'show'])
                         ->name('show');

                    // admin::seo.metas.edit
                    $this->get('edit', [MetasController::class, 'edit'])
                         ->name('edit');

                    // admin::seo.metas.update
                    $this->put('update', [MetasController::class, 'update'])
                         ->name('update');
                });
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Seo\Repositories\MetasRepository  $repo
     */
    public function bindings(MetasRepository $repo): void
    {
        $this->bind(static::WILDCARD_PAGE, function (string $id) use ($repo) {
            return $repo->findOrFail($id);
        });
    }
}
