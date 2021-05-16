<?php declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Controllers;

use Arcanesoft\Foundation\Support\Traits\HasNotifications;
use Arcanesoft\Seo\Http\Routes\MetasRoutes;
use Arcanesoft\Seo\Policies\MetasPolicy;

/**
 * Class     MetasController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetasController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasNotifications;

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

        $this->setCurrentSidebarItem('seo::main.metas');
        $this->addBreadcrumbRoute(__('Metas'), MetasRoutes::ROUTE_INDEX);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Display the index page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->authorize(MetasPolicy::ability('index'));

        return $this->view('metas.index');
    }
}
