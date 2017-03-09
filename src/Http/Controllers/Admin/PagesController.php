<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

use Arcanesoft\Seo\Entities\Locales;
use Arcanesoft\Seo\Http\Requests\Admin\Pages\CreatePageRequest;
use Arcanesoft\Seo\Http\Requests\Admin\Pages\UpdatePageRequest;
use Arcanesoft\Seo\Models\Page;
use Illuminate\Support\Facades\Log;

/**
 * Class     PagesController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @todo: Add authorization checks
 */
class PagesController extends Controller
{
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
        $this->addBreadcrumbRoute('Pages', 'admin::seo.pages.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    public function index()
    {
        $this->setTitle($title = 'List of Pages');
        $this->addBreadcrumb($title);

        $pages = Page::with(['footers'])->paginate(50);

        return $this->view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $this->setTitle($title = 'New Page');
        $this->addBreadcrumb($title);

        $locales = Locales::all();

        return $this->view('admin.pages.create', compact('locales'));
    }

    public function store(CreatePageRequest $request)
    {
        $page = Page::createOne(
            $request->only(['name', 'locale', 'content'])
        );

        $message = "The page was created successfully !";
        Log::info($message, $page->toArray());
        $this->notifySuccess($message, 'Page created !');

        return redirect()->route('admin::seo.pages.show', [$page]);
    }

    public function show(Page $page)
    {
        $this->setTitle($title = 'Page details');
        $this->addBreadcrumb($title);

        $page->load(['footers.seo']);

        return $this->view('admin.pages.show', compact('page'));
    }

    public function edit(Page $page)
    {
        $this->setTitle($title = 'Edit Page');
        $this->addBreadcrumb($title);

        $locales = Locales::all();

        return $this->view('admin.pages.edit', compact('page', 'locales'));
    }

    public function update(Page $page, UpdatePageRequest $request)
    {
        $page->updateOne(
            $request->only(['name', 'locale', 'content'])
        );

        $message = "The page was updated successfully !";
        Log::info($message, $page->toArray());
        $this->notifySuccess($message, 'Page updated !');

        return redirect()->route('admin::seo.pages.show', [$page]);
    }

    public function delete(Page $page)
    {
        $page->delete();

        $message = 'The page was deleted successfully !';
        Log::info($message, $page->toArray());
        $this->notifySuccess($message, 'Page deleted !');

        return json_response()->success($message);
    }
}
