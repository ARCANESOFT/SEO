<?php namespace Arcanesoft\Seo\Http\Controllers\Admin;

use Arcanesoft\Seo\Models\Meta;

/**
 * Class     MetasController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
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
        $this->addBreadcrumbRoute('Metas', 'admin::seo.metas.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    public function index()
    {
        $this->setTitle($title = 'List of Metas');
        $this->addBreadcrumb($title);

        $metas = Meta::paginate(50);

        return $this->view('admin.metas.index', compact('metas'));
    }

    public function show(Meta $meta)
    {
        $this->setTitle($title = 'Meta details');
        $this->addBreadcrumb($title);

        $meta->load(['seoable']);

        return $this->view('admin.metas.show', compact('meta'));
    }
}
