<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Datatables;

use Arcanesoft\Seo\Http\Routes\PagesRoutes;
use Arcanesoft\Seo\Http\Transformers\PageTransformer;
use Arcanesoft\Seo\Policies\PagesPolicy;
use Arcanesoft\Seo\Repositories\PagesRepository;
use Arcanesoft\Foundation\Datatable\{Action, Column, Datatable};
use Arcanesoft\Foundation\Datatable\Concerns\{HasActions, HasFilters, HasPagination};
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class     PagesDatatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PagesDatatable extends Datatable
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
     * @param  \Arcanesoft\Seo\Repositories\PagesRepository  $repo
     * @param  \Illuminate\Http\Request                      $request
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function handle(PagesRepository $repo, Request $request)
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
            Column::make('lang', 'Language')->sortable(),
            Column::make('created_at', 'Created at')->sortable()->align('center'),
        ];
    }

    /**
     * Define the datatable actions.
     *
     * @param  \Illuminate\Http\Request           $request
     * @param  \Arcanesoft\Seo\Models\Page|mixed  $page
     *
     * @return array
     */
    protected function actions(Request $request, $page): array
    {
        $actions = [];

        $actions[] = Action::link('show', 'Show', function () use ($page) {
            return route(PagesRoutes::ROUTE_SHOW, [$page]);
        })->can(function () use ($page) {
            return PagesPolicy::can('show', [$page]);
        })->asIcon();

        $actions[] = Action::link('edit', 'Edit', function () use ($page) {
            return route(PagesRoutes::ROUTE_EDIT, [$page]);
        })->can(function () use ($page) {
            return PagesPolicy::can('update', [$page]);
        })->asIcon();

        $actions[] = Action::button('delete', 'Delete', function () use ($page) {
            return "ARCANESOFT.emit('seo::pages.delete', {id: '{$page->getRouteKey()}'})";
        })->can(function () use ($page) {
            return PagesPolicy::can('delete', [$page]);
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
        return new PageTransformer;
    }
}
