<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

use Arcanesoft\Seo\Models\Meta;
use Arcanesoft\Seo\Policies;

/**
 * Class     MetasController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @todo: Add authorization checks.
 */
class MetasController extends Controller
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

        $this->setCurrentPage('seo-metas');
        $this->addBreadcrumbRoute(trans('seo::metas.titles.metas'), 'admin::seo.metas.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(Policies\MetasPolicy::PERMISSION_LIST);

        $metas = Meta::paginate(50);

        $this->setTitle($title = trans('seo::metas.titles.metas-list'));
        $this->addBreadcrumb($title);

        return $this->view('admin.metas.index', compact('metas'));
    }

    public function show(Meta $meta)
    {
        $this->authorize(Policies\MetasPolicy::PERMISSION_SHOW);

        $meta->load(['seoable']);

        $this->setTitle($title = trans('seo::metas.titles.metas-details'));
        $this->addBreadcrumb($title);

        return $this->view('admin.metas.show', compact('meta'));
    }
}
