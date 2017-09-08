<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

use Arcanesoft\Seo\Entities\Locales;
use Arcanesoft\Seo\Http\Requests\Admin\Footers\CreateFooterRequest;
use Arcanesoft\Seo\Http\Requests\Admin\Footers\UpdateFooterRequest;
use Arcanesoft\Seo\Models\Footer;
use Arcanesoft\Seo\Models\Page;
use Arcanesoft\Seo\Policies;
use Illuminate\Support\Facades\Log;

/**
 * Class     FootersController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FootersController extends Controller
{
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

        $this->setCurrentPage('seo-footers');
        $this->addBreadcrumbRoute(trans('seo::footers.titles.footers'), 'admin::seo.footers.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(Policies\FootersPolicy::PERMISSION_LIST);

        $footers = Footer::with(['page', 'seo'])->paginate(50);

        $this->setTitle($title = trans('seo::footers.titles.footers-list'));
        $this->addBreadcrumb($title);

        return $this->view('admin.footers.index', compact('footers'));
    }

    public function create()
    {
        $this->authorize(Policies\FootersPolicy::PERMISSION_CREATE);

        $pages   = Page::getSelectData();
        $locales = Locales::all();

        $this->setTitle($title = trans('seo::footers.titles.new-footer'));
        $this->addBreadcrumb($title);

        return $this->view('admin.footers.create', compact('pages', 'locales'));
    }

    public function store(CreateFooterRequest $request)
    {
        $this->authorize(Policies\FootersPolicy::PERMISSION_CREATE);

        $footer = Footer::createOne(
            $request->getValidatedData()
        );

        $this->transNotification('created', ['name' => $footer->name], $footer->toArray());

        return redirect()->route('admin::seo.footers.show', [$footer]);
    }

    public function show(Footer $footer)
    {
        $this->authorize(Policies\FootersPolicy::PERMISSION_SHOW);

        $footer->load(['page', 'seo']);

        $this->setTitle($title = trans('seo::footers.titles.footer-details'));
        $this->addBreadcrumb($title);

        return $this->view('admin.footers.show', compact('footer'));
    }

    public function edit(Footer $footer)
    {
        $this->authorize(Policies\FootersPolicy::PERMISSION_UPDATE);

        $footer->load(['page', 'seo']);

        $pages   = Page::getSelectData();
        $locales = Locales::all();

        $this->setTitle($title = trans('seo::footers.titles.edit-footer'));
        $this->addBreadcrumb($title);

        return $this->view('admin.footers.edit', compact('footer', 'pages', 'locales'));
    }

    public function update(Footer $footer, UpdateFooterRequest $request)
    {
        $this->authorize(Policies\FootersPolicy::PERMISSION_UPDATE);

        $footer->updateOne(
            $request->getValidatedData()
        );

        $this->transNotification('updated', ['name' => $footer->name], $footer->toArray());

        return redirect()->route('admin::seo.footers.show', [$footer]);
    }

    public function delete(Footer $footer)
    {
        $this->authorize(Policies\FootersPolicy::PERMISSION_DELETE);

        $footer->delete();

        return $this->jsonResponseSuccess([
            'message' => $this->transNotification('deleted', ['name' => $footer->name], $footer->toArray())
        ]);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Notify with translation.
     *
     * @todo: Refactor this method to the core package ?
     *
     * @param  string  $action
     * @param  array   $replace
     * @param  array   $context
     *
     * @return string
     */
    protected function transNotification($action, array $replace = [], array $context = [])
    {
        $title   = trans("seo::footers.messages.{$action}.title");
        $message = trans("seo::footers.messages.{$action}.message", $replace);

        Log::info($message, $context);
        $this->notifySuccess($message, $title);

        return $message;
    }
}
