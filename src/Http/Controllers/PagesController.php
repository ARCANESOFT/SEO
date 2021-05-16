<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Controllers;

use Arcanesoft\Foundation\Support\Traits\HasNotifications;
use Arcanesoft\Seo\Http\Datatables\PagesDatatable;
use Arcanesoft\Seo\Http\Requests\Pages\{CreatePageRequest, UpdatePageRequest};
use Arcanesoft\Seo\Http\Routes\PagesRoutes;
use Arcanesoft\Seo\Models\Page;
use Arcanesoft\Seo\Policies\PagesPolicy;
use Arcanesoft\Seo\Repositories\PagesRepository;

/**
 * Class     PagesController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PagesController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasNotifications;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * PagesController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('seo::main.pages');
        $this->addBreadcrumbRoute(__('Pages'), PagesRoutes::ROUTE_INDEX);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Display the index page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->authorize(PagesPolicy::ability('index'));

        return $this->view('pages.index');
    }

    /**
     * Get the datatable response.
     *
     * @param  \Arcanesoft\Seo\Http\Datatables\PagesDatatable  $datatable
     *
     * @return \Arcanesoft\Seo\Http\Datatables\PagesDatatable
     */
    public function datatable(PagesDatatable $datatable)
    {
        $this->authorize(PagesPolicy::ability('index'));

        return $datatable;
    }

    /**
     * Display the metrics.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function metrics()
    {
        $this->authorize(PagesPolicy::ability('metrics'));

        $this->addBreadcrumbRoute(__('Metrics'), PagesRoutes::ROUTE_METRICS);

        $this->selectMetrics('arcanesoft.seo.metrics.pages');

        return $this->view('pages.metrics');
    }

    /**
     * Display the create form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $this->authorize(PagesPolicy::ability('create'));

        $this->addBreadcrumb(__('New Page'));

        return $this->view('pages.create');
    }

    /**
     * Store the submitted form.
     *
     * @param  \Arcanesoft\Seo\Http\Requests\Pages\CreatePageRequest  $request
     * @param  \Arcanesoft\Seo\Repositories\PagesRepository           $repo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePageRequest $request, PagesRepository $repo)
    {
        $this->authorize(PagesPolicy::ability('create'));

        $page = $repo->createOne($request->validated());

        $this->notifySuccess(
            __('Page Created'),
            __('A new post has been successfully created!')
        );

        return redirect()->route(PagesRoutes::ROUTE_SHOW, [$page]);
    }

    /**
     * Show the resource.
     *
     * @param  \Arcanesoft\Seo\Models\Page  $page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Page $page)
    {
        $this->authorize(PagesPolicy::ability('show'));

        $this->addBreadcrumbRoute(__("Page's details"), PagesRoutes::ROUTE_SHOW, [$page]);

        return $this->view('pages.show', compact('page'));
    }

    /**
     * @param  \Arcanesoft\Seo\Models\Page  $page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Page $page)
    {
        $this->authorize(PagesPolicy::ability('update'), [$page]);

        $this->addBreadcrumbRoute(__('Edit Page'), PagesRoutes::ROUTE_EDIT, [$page]);

        return $this->view('pages.edit', compact('page'));
    }

    /**
     * @param  \Arcanesoft\Seo\Models\Page                            $page
     * @param  \Arcanesoft\Seo\Http\Requests\Pages\UpdatePageRequest  $request
     * @param  \Arcanesoft\Seo\Repositories\PagesRepository           $repo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Page $page, UpdatePageRequest $request, PagesRepository $repo)
    {
        $this->authorize(PagesPolicy::ability('update'), [$page]);

        $repo->updateOne($page, $request->validated());

        $this->notifySuccess(
            __('Page Updated'),
            __('The post has been successfully updated!')
        );

        return redirect()->route(PagesRoutes::ROUTE_SHOW, [$page]);
    }

    /**
     * @param  \Arcanesoft\Seo\Models\Page                   $page
     * @param  \Arcanesoft\Seo\Repositories\PagesRepository  $repo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Page $page, PagesRepository $repo)
    {
        $this->authorize(PagesPolicy::ability('delete'), [$page]);

        $repo->deleteOne($page);

        $this->notifySuccess(
            __('Page Deleted'),
            __('The post has been successfully deleted!')
        );

        return $this->jsonResponseSuccess();
    }
}
