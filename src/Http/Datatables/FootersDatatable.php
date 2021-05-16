<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Datatables;

use Arcanesoft\Foundation\Datatable\Action;
use Arcanesoft\Foundation\Datatable\Column;
use Arcanesoft\Foundation\Datatable\Concerns\HasActions;
use Arcanesoft\Foundation\Datatable\Concerns\HasFilters;
use Arcanesoft\Foundation\Datatable\Concerns\HasPagination;
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Arcanesoft\Foundation\Datatable\Datatable;
use Arcanesoft\Seo\Http\Routes\FootersRoutes;
use Arcanesoft\Seo\Http\Transformers\FooterTransformer;
use Arcanesoft\Seo\Policies\FootersPolicy;
use Arcanesoft\Seo\Repositories\FootersRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class     FootersDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FootersDatatable extends Datatable
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasActions;
    use HasFilters;
    use HasPagination;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the datatable request.
     *
     * @param  \Arcanesoft\Seo\Repositories\FootersRepository  $repo
     * @param  \Illuminate\Http\Request                        $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function handle(FootersRepository $repo, Request $request)
    {
        $query = $repo->query();

        $this->handleSearchQuery($request, $query);

        return $query;
    }

    /**
     * @param  \Illuminate\Http\Request               $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function handleSearchQuery(Request $request, Builder $query): Builder
    {
        $search = $this->searchQuery($request);

        return $query->unless(empty($search), function (Builder $q) use ($search) {
            return $q->where('name', 'like', '%'.$search.'%');
        });
    }

    /**
     * Define the datatable's columns.
     *
     * @return \Arcanesoft\Foundation\Datatable\Column[]|array
     */
    protected function columns(): array
    {
        return [
            Column::make('name', 'Name')->sortable(),
            Column::make('url', 'URL')->sortable(),
            Column::make('created_at', 'Created at')->sortable()->align('center'),
        ];
    }

    /**
     * Define the datatable actions.
     *
     * @param  \Illuminate\Http\Request             $request
     * @param  \Arcanesoft\Seo\Models\Footer|mixed  $footer
     *
     * @return array
     */
    protected function actions(Request $request, $footer): array
    {
        $actions = [];

        $actions[] = Action::link('show', 'Show', function () use ($footer) {
            return route(FootersRoutes::ROUTE_SHOW, [$footer]);
        })->can(function () use ($footer) {
            return FootersPolicy::can('show', [$footer]);
        })->asIcon();

        $actions[] = Action::link('edit', 'Edit', function () use ($footer) {
            return route(FootersRoutes::ROUTE_EDIT, [$footer]);
        })->can(function () use ($footer) {
            return FootersPolicy::can('update', [$footer]);
        })->asIcon();

        $actions[] = Action::button('delete', 'Delete', function () use ($footer) {
            return "ARCANESOFT.emit('seo::footers.delete', {id: '{$footer->getRouteKey()}'})";
        })->can(function () use ($footer) {
            return FootersPolicy::can('delete', [$footer]);
        })->asIcon();

        return $actions;
    }

    /**
     * Define the datatable filters.
     *
     * @return \Arcanesoft\Foundation\Datatable\Contracts\Filter[]
     */
    protected function filters(Request $request): array
    {
        return [
            //
        ];
    }

    /**
     * Get the transformer.
     *
     * @return \Arcanesoft\Foundation\Datatable\Contracts\Transformer
     */
    protected function transformer(): Transformer
    {
        return new FooterTransformer;
    }
}
