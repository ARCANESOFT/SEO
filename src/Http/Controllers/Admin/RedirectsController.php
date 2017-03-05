<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

use Arcanedev\LaravelSeo\Entities\RedirectStatuses;
use Arcanedev\LaravelSeo\Models\Redirect;
use Arcanesoft\Seo\Http\Requests\Admin\Redirects\CreateRedirectRequest;
use Arcanesoft\Seo\Http\Requests\Admin\Redirects\UpdateRedirectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class     RedirectsController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @todo: Add authorization checks
 */
class RedirectsController extends Controller
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */
    /**
     * MetasController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentPage('seo-redirects');
        $this->addBreadcrumbRoute('Redirections', 'admin::seo.redirects.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    public function index()
    {
        $this->setTitle($title = 'List of Redirections');
        $this->addBreadcrumb($title);

        $redirects = Redirect::all();

        return $this->view('admin.redirects.index', compact('redirects'));
    }

    public function create()
    {
        $this->setTitle($title = 'New Redirection');
        $this->addBreadcrumb($title);

        $statuses = RedirectStatuses::all();

        return $this->view('admin.redirects.create', compact('statuses'));
    }

    public function store(CreateRedirectRequest $request)
    {
        $redirect = Redirect::createOne(
            $request->get('old_url'),
            $request->get('new_url'),
            $request->get('status')
        );

        $message = "The redirection was created successfully !";
        Log::info($message, $redirect->toArray());
        $this->notifySuccess($message, 'Redirection created !');

        return redirect()->route('admin::seo.redirects.index');
    }

    public function show(Redirect $redirect)
    {
        $this->setTitle($title = 'Redirection details');
        $this->addBreadcrumb($title);

        return $this->view('admin.redirects.show', compact('redirect'));
    }

    public function edit(Redirect $redirect)
    {
        $this->setTitle($title = 'Edit Redirection');
        $this->addBreadcrumb($title);

        $statuses = RedirectStatuses::all();

        return $this->view('admin.redirects.edit', compact('redirect', 'statuses'));
    }

    public function update(Redirect $redirect, UpdateRedirectRequest $request)
    {
        $redirect->update(
            $request->only(['old_url', 'new_url', 'status'])
        );

        $message = "The redirection was updated successfully !";
        Log::info($message, $redirect->toArray());
        $this->notifySuccess($message, 'Redirection updated !');

        return redirect()->route('admin::seo.redirects.show', [$redirect]);
    }

    public function delete(Redirect $redirect)
    {
        $redirect->delete();

        $message = "The redirection was deleted successfully !";
        Log::info($message, $redirect->toArray());
        $this->notifySuccess($message, 'Redirection deleted !');

        return json_response()->success($message);
    }
}
