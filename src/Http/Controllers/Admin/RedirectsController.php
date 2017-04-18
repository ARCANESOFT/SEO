<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

use Arcanedev\LaravelApiHelper\Traits\JsonResponses;
use Arcanedev\LaravelSeo\Entities\RedirectStatuses;
use Arcanesoft\Seo\Http\Requests\Admin\Redirects\CreateRedirectRequest;
use Arcanesoft\Seo\Http\Requests\Admin\Redirects\UpdateRedirectRequest;
use Arcanesoft\Seo\Models\Redirect;
use Arcanesoft\Seo\Policies\RedirectsPolicy;
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
     |  Traits
     | -----------------------------------------------------------------
     */

    use JsonResponses;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * RedirectsController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentPage('seo-redirects');
        $this->addBreadcrumbRoute(trans('seo::redirects.titles.redirections'), 'admin::seo.redirects.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize(RedirectsPolicy::PERMISSION_LIST);

        $redirects = Redirect::paginate(50);

        $this->setTitle($title = trans('seo::redirects.titles.redirections-list'));
        $this->addBreadcrumb($title);

        return $this->view('admin.redirects.index', compact('redirects'));
    }

    /**
     * Get the create form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize(RedirectsPolicy::PERMISSION_CREATE);

        $statuses = RedirectStatuses::all();

        $this->setTitle($title = trans('seo::redirects.titles.create-redirection'));
        $this->addBreadcrumb($title);

        return $this->view('admin.redirects.create', compact('statuses'));
    }

    /**
     * Store the new redirect.
     *
     * @param  \Arcanesoft\Seo\Http\Requests\Admin\Redirects\CreateRedirectRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRedirectRequest $request)
    {
        $this->authorize(RedirectsPolicy::PERMISSION_CREATE);

        $redirect = Redirect::createRedirect(
            $request->getValidatedInputs()
        );

        $this->transNotification('created', [], $redirect->toArray());

        return redirect()->route('admin::seo.redirects.show', [$redirect]);
    }

    /**
     * Show the redirect details page.
     *
     * @param  \Arcanesoft\Seo\Models\Redirect  $redirect
     *
     * @return \Illuminate\View\View
     */
    public function show(Redirect $redirect)
    {
        $this->authorize(RedirectsPolicy::PERMISSION_SHOW);

        $this->setTitle($title = trans('seo::redirects.titles.redirection-details'));
        $this->addBreadcrumb($title);

        return $this->view('admin.redirects.show', compact('redirect'));
    }

    /**
     * Get the edit page.
     *
     * @param  \Arcanesoft\Seo\Models\Redirect  $redirect
     *
     * @return \Illuminate\View\View
     */
    public function edit(Redirect $redirect)
    {
        $this->authorize(RedirectsPolicy::PERMISSION_UPDATE);

        $statuses = RedirectStatuses::all();

        $this->setTitle($title = trans('seo::redirects.titles.edit-redirection'));
        $this->addBreadcrumb($title);

        return $this->view('admin.redirects.edit', compact('redirect', 'statuses'));
    }

    /**
     * Update the redirect.
     *
     * @param  \Arcanesoft\Seo\Models\Redirect                                      $redirect
     * @param  \Arcanesoft\Seo\Http\Requests\Admin\Redirects\UpdateRedirectRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Redirect $redirect, UpdateRedirectRequest $request)
    {
        $this->authorize(RedirectsPolicy::PERMISSION_UPDATE);

        $redirect->update($request->getValidatedInputs());

        $this->transNotification('updated', [], $redirect->toArray());

        return redirect()->route('admin::seo.redirects.show', [$redirect]);
    }

    /**
     * Delete a redirect record.
     *
     * @param  \Arcanesoft\Seo\Models\Redirect  $redirect
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Redirect $redirect)
    {
        $this->authorize(RedirectsPolicy::PERMISSION_DELETE);

        $redirect->delete();

        return $this->jsonResponseSuccess([
            'message' => $this->transNotification('deleted', [], $redirect->toArray())
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
        $title   = trans("seo::redirects.messages.{$action}.title");
        $message = trans("seo::redirects.messages.{$action}.message", $replace);

        Log::info($message, $context);
        $this->notifySuccess($message, $title);

        return $message;
    }
}
