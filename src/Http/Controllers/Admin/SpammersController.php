<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

use Arcanedev\SpamBlocker\Contracts\SpamBlocker;

/**
 * Class     SpammersController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SpammersController extends Controller
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The spam blocker instance.
     *
     * @var \Arcanedev\SpamBlocker\Contracts\SpamBlocker
     */
    protected $blocker;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * MetasController constructor.
     */
    public function __construct(SpamBlocker $blocker)
    {
        parent::__construct();

        $this->blocker = $blocker;

        $this->setCurrentPage('seo-spammers');
        $this->addBreadcrumbRoute('Spammers', 'admin::seo.spammers.index');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function index()
    {
        $this->setTitle($title = 'List of Spammers');
        $this->addBreadcrumb($title);

        $spammers = $this->blocker->all();

        return $this->view('admin.spammers.index', compact('spammers'));
    }
}
