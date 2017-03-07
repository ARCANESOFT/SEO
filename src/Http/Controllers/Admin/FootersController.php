<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

use Arcanesoft\Seo\Entities\Locales;
use Arcanesoft\Seo\Http\Requests\Admin\Footers\CreateFooterRequest;
use Arcanesoft\Seo\Http\Requests\Admin\Footers\UpdateFooterRequest;
use Arcanesoft\Seo\Models\Footer;
use Arcanesoft\Seo\Models\Page;
use Illuminate\Support\Facades\Log;

/**
 * Class     FootersController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @todo: Add authorization checks
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
        $this->addBreadcrumbRoute('Footers', 'admin::seo.footers.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    public function index()
    {
        $this->setTitle($title = 'List of Footers');
        $this->addBreadcrumb($title);

        $footers = Footer::with(['page', 'seo'])->paginate(50);

        return $this->view('admin.footers.index', compact('footers'));
    }

    public function create()
    {
        $this->setTitle($title = 'New Footer');
        $this->addBreadcrumb($title);

        $pages   = Page::getSelectInputData();
        $locales = Locales::all();

        return $this->view('admin.footers.create', compact('pages', 'locales'));
    }

    public function store(CreateFooterRequest $request)
    {
        $inputs = $request->only([
            'name', 'localization', 'uri', 'locale', 'page',
            'seo_title', 'seo_description', 'seo_keywords',
        ]);

        $footer = Footer::createOne($inputs);

        $message = 'The footer was created successfully !';
        Log::info($message, $footer->toArray());
        $this->notifySuccess($message, 'Footer created !');

        return redirect()->route('admin::seo.footers.show', [$footer]);
    }

    public function show(Footer $footer)
    {
        $this->setTitle($title = 'Footer details');
        $this->addBreadcrumb($title);

        $footer->load(['page', 'seo']);

        return $this->view('admin.footers.show', compact('footer'));
    }

    public function edit(Footer $footer)
    {
        $this->setTitle($title = 'Edit Footer');
        $this->addBreadcrumb($title);

        $footer->load(['page', 'seo']);

        $pages   = Page::getSelectInputData();
        $locales = Locales::all();

        return $this->view('admin.footers.edit', compact('footer', 'pages', 'locales'));
    }

    public function update(Footer $footer, UpdateFooterRequest $request)
    {
        dd($request->all());
        $footer->updateOne(
            //
        );

        $message = 'The footer was updated successfully !';
        Log::info($message, $footer->toArray());
        $this->notifySuccess($message, 'Footer updated !');

        return redirect()->route('admin::seo.footers.show', [$footer]);
    }

    public function delete(Footer $footer)
    {
        $footer->delete();

        $message = 'The footer was deleted successfully !';
        Log::info($message, $footer->toArray());
        $this->notifySuccess($message, 'Footer deleted !');

        return json_response()->success($message);
    }
}
