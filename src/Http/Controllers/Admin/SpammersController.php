<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

use Arcanedev\SpamBlocker\Contracts\SpamBlocker;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Class     SpammersController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SpammersController extends Controller
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */
    /**
     * The spam blocker instance.
     *
     * @var \Arcanedev\SpamBlocker\Contracts\SpamBlocker
     */
    protected $blocker;

    /**
     * Number of items per page for pagination.
     *
     * @var int
     */
    protected $perPage = 50;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */
    /**
     * MetasController constructor.
     *
     * @param  \Arcanedev\SpamBlocker\Contracts\SpamBlocker  $blocker
     */
    public function __construct(SpamBlocker $blocker)
    {
        parent::__construct();

        $this->blocker = $blocker;

        $this->setCurrentPage('seo-spammers');
        $this->addBreadcrumbRoute('Spammers', 'admin::seo.spammers.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * List all the spammers.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->setTitle($title = 'List of Spammers');
        $this->addBreadcrumb($title);

        $spammers = $this->paginate($this->blocker->all(), $request, $this->perPage);

        return $this->view('admin.spammers.index', compact('spammers'));
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */
    /**
     * Paginate the collection.
     *
     * @param  \Illuminate\Support\Collection  $data
     * @param  \Illuminate\Http\Request        $request
     * @param  int                             $perPage
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function paginate(Collection $data, Request $request, $perPage)
    {
        $page = $request->get('page', 1);
        $path = $request->url();

        return new LengthAwarePaginator(
            $data->forPage($page, $perPage),
            $data->count(),
            $perPage,
            $page,
            compact('path')
        );
    }
}
