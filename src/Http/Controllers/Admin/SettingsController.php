<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

use Arcanedev\LaravelSeo\Seo;

/**
 * Class     SettingsController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @todo: Add authorization checks
 */
class SettingsController extends Controller
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */
    /**
     * SettingsController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentPage('seo-settings');
        $this->addBreadcrumbRoute('Settings', 'admin::seo.settings.index');
    }

    public function index()
    {
        $this->setTitle($title = 'Settings');
        $this->addBreadcrumb($title);

        $redirector = Seo::getConfig('redirector');

        return $this->view('admin.settings', compact('redirector'));
    }
}
