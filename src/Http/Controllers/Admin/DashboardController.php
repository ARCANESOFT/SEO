<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

/**
 * Class     DashboardController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardController extends Controller
{
    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentPage('seo-dashboard');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function index()
    {
        $this->setTitle('Seo');

        return $this->view('admin.dashboard');
    }
}
