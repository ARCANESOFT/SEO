<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

use Arcanedev\LaravelApiHelper\Traits\JsonResponses;
use Arcanesoft\Seo\Entities\Locales;
use Arcanesoft\Seo\Http\Requests\Admin\Pages\CreatePageRequest;
use Arcanesoft\Seo\Http\Requests\Admin\Pages\UpdatePageRequest;
use Arcanesoft\Seo\Models\Page;
use Arcanesoft\Seo\Policies;
use Illuminate\Support\Facades\Log;

/**
 * Class     PagesController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PagesController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use JsonResponses;

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

        $this->setCurrentPage('seo-pages');
        $this->addBreadcrumbRoute(trans('seo::pages.titles.pages'), 'admin::seo.pages.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(Policies\PagesPolicy::PERMISSION_LIST);

        $pages = Page::with(['footers'])->paginate(50);

        $this->setTitle($title = trans('seo::pages.titles.pages-list'));
        $this->addBreadcrumb($title);

        return $this->view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $this->authorize(Policies\PagesPolicy::PERMISSION_CREATE);

        $locales = Locales::all();

        $this->setTitle($title = trans('seo::pages.titles.new-page'));
        $this->addBreadcrumb($title);

        return $this->view('admin.pages.create', compact('locales'));
    }

    public function store(CreatePageRequest $request)
    {
        $this->authorize(Policies\PagesPolicy::PERMISSION_CREATE);

        $page = Page::createOne(
            $request->getValidatedValidated()
        );

        $this->transNotification('created', ['name' => $page->name], $page->toArray());

        return redirect()->route('admin::seo.pages.show', [$page]);
    }

    public function show(Page $page)
    {
        $this->authorize(Policies\PagesPolicy::PERMISSION_SHOW);

        $page->load(['footers.seo']);

        $this->setTitle($title = trans('seo::pages.titles.page-details'));
        $this->addBreadcrumb($title);

        return $this->view('admin.pages.show', compact('page'));
    }

    public function edit(Page $page)
    {
        $this->authorize(Policies\PagesPolicy::PERMISSION_UPDATE);

        $locales = Locales::all();

        $this->setTitle($title = trans('seo::pages.titles.edit-page'));
        $this->addBreadcrumb($title);

        return $this->view('admin.pages.edit', compact('page', 'locales'));
    }

    public function update(Page $page, UpdatePageRequest $request)
    {
        $this->authorize(Policies\PagesPolicy::PERMISSION_UPDATE);

        $page->updateOne(
            $request->getValidatedValidated()
        );

        $this->transNotification('updated', ['name' => $page->name], $page->toArray());

        return redirect()->route('admin::seo.pages.show', [$page]);
    }

    public function delete(Page $page)
    {
        $this->authorize(Policies\PagesPolicy::PERMISSION_DELETE);

        $page->delete();

        return $this->jsonResponseSuccess([
            'message' => $this->transNotification('deleted', ['name' => $page->name], $page->toArray())
        ]);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Notify with translation.
     *
     * @param  string  $action
     * @param  array   $replace
     * @param  array   $context
     *
     * @return string
     */
    protected function transNotification($action, array $replace = [], array $context = [])
    {
        $title   = trans("seo::pages.messages.{$action}.title");
        $message = trans("seo::pages.messages.{$action}.message", $replace);

        Log::info($message, $context);
        $this->notifySuccess($message, $title);

        return $message;
    }
}
