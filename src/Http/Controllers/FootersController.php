<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Controllers;

use Arcanesoft\Foundation\Support\Traits\HasNotifications;
use Arcanesoft\Seo\Http\Datatables\FootersDatatable;
use Arcanesoft\Seo\Http\Requests\Footers\{
    CreateFooterRequest,
    UpdateFooterRequest};
use Arcanesoft\Seo\Http\Routes\FootersRoutes;
use Arcanesoft\Seo\Models\Footer;
use Arcanesoft\Seo\Policies\FootersPolicy;
use Arcanesoft\Seo\Repositories\FootersRepository;
use Arcanesoft\Seo\Repositories\PagesRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class     FootersController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FootersController extends Controller
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
     * FootersController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('seo::main.footers');
        $this->addBreadcrumbRoute(__('Footers'), FootersRoutes::ROUTE_INDEX);
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
        $this->authorize(FootersPolicy::ability('index'));

        return $this->view('footers.index');
    }

    /**
     * Get the datatable response.
     *
     * @param  \Arcanesoft\Seo\Http\Datatables\FootersDatatable  $datatable
     *
     * @return \Arcanesoft\Seo\Http\Datatables\FootersDatatable
     */
    public function datatable(FootersDatatable $datatable)
    {
        $this->authorize(FootersPolicy::ability('index'));

        return $datatable;
    }

    /**
     * Display the metrics.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function metrics()
    {
        $this->authorize(FootersPolicy::ability('metrics'));

        $this->addBreadcrumbRoute(__('Metrics'), FootersRoutes::ROUTE_METRICS);

        $this->selectMetrics('arcanesoft.seo.metrics.footers');

        return $this->view('footers.metrics');
    }

    /**
     * Display the create form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(PagesRepository $pagesRepo)
    {
        $this->authorize(FootersPolicy::ability('create'));

        $this->addBreadcrumb(__('New Footer'));

        $pages = $pagesRepo->pagePlaceholders();

        return $this->view('footers.create', compact('pages'));
    }

    /**
     * Store the submitted form.
     *
     * @param  \Arcanesoft\Seo\Http\Requests\Footers\CreateFooterRequest  $request
     * @param  \Arcanesoft\Seo\Repositories\FootersRepository             $repo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateFooterRequest $request, FootersRepository $repo)
    {
        $this->authorize(FootersPolicy::ability('create'));

        $footer = $repo->createOne($request->validated());

        $this->notifySuccess(
            __('Footer Created'),
            __('A new footer has been successfully created!')
        );

        return redirect()->route(FootersRoutes::ROUTE_SHOW, [$footer]);
    }

    /**
     * Show the resource.
     *
     * @param  \Arcanesoft\Seo\Models\Footer  $footer
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Footer $footer)
    {
        $this->authorize(FootersPolicy::ability('show'));

        $footer->load(['page', 'meta']);

        $this->addBreadcrumbRoute(__("Footer's details"), FootersRoutes::ROUTE_SHOW, [$footer]);

        return $this->view('footers.show', compact('footer'));
    }

    /**
     * Display the edit form.
     *
     * @param  \Arcanesoft\Seo\Models\Footer  $footer
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Footer $footer, PagesRepository $pagesRepo)
    {
        $this->authorize(FootersPolicy::ability('update'), [$footer]);

        $footer->load(['page', 'meta']);

        $this->addBreadcrumbRoute(__('Edit Footer'), FootersRoutes::ROUTE_EDIT, [$footer]);

        $pages = $pagesRepo->pagePlaceholders();

        return $this->view('footers.edit', compact('footer', 'pages'));
    }

    /**
     * Update the submitted form.
     *
     * @param  \Arcanesoft\Seo\Models\Footer                              $footer
     * @param  \Arcanesoft\Seo\Http\Requests\Footers\UpdateFooterRequest  $request
     * @param  \Arcanesoft\Seo\Repositories\FootersRepository             $repo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Footer $footer, UpdateFooterRequest $request, FootersRepository $repo)
    {
        $this->authorize(FootersPolicy::ability('update'), [$footer]);

        $repo->updateOne($footer, $request->validated());

        $this->notifySuccess(
            __('Footer Updated'),
            __('The footer has been successfully updated!')
        );

        return redirect()->route(FootersRoutes::ROUTE_SHOW, [$footer]);
    }

    /**
     * @param  \Arcanesoft\Seo\Models\Footer                   $footer
     * @param  \Arcanesoft\Seo\Repositories\FootersRepository  $repo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Footer $footer, FootersRepository $repo): JsonResponse
    {
        $this->authorize(FootersPolicy::ability('delete'), [$footer]);

        $repo->deleteOne($footer);

        $this->notifySuccess(
            __('Footer Deleted'),
            __('The footer has been successfully deleted!')
        );

        return $this->jsonResponseSuccess();
    }
}
