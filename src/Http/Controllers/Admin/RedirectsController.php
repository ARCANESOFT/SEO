<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

use Arcanedev\LaravelSeo\Entities\RedirectStatuses;
use Arcanedev\LaravelSeo\Models\Redirect;
use Arcanesoft\Seo\Http\Requests\Admin\Redirects\CreateRedirectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class     RedirectsController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
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
        // TODO: Add authorize check

        $this->setTitle($title = 'List of Redirections');
        $this->addBreadcrumb($title);

        $redirects = Redirect::all();

        return $this->view('admin.redirects.index', compact('redirects'));
    }

    public function create()
    {
        // TODO: Add authorize check

        $this->setTitle($title = 'New Redirection');
        $this->addBreadcrumb($title);

        $statuses = RedirectStatuses::all();

        return $this->view('admin.redirects.create', compact('statuses'));
    }

    public function store(CreateRedirectRequest $request)
    {
        // TODO: Add authorize check

        $redirect = Redirect::createOne(
            $request->get('old_url'),
            $request->get('new_url'),
            $request->get('status')
        );

        $message = "The redirection was created successfully !";
        Log::info($message, $post->toArray());
        $this->notifySuccess($message, 'Redirection created !');

        return redirect()->route('admin::seo.redirects.index');
    }
}
