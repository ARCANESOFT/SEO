<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

/**
 * Class     DashboardController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardController extends Controller
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentPage('seo-dashboard');
        $this->addBreadcrumbRoute('Statistics', 'admin::seo.stats.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->setTitle('Statistics');

        return $this->view('admin.dashboard');
    }
}
