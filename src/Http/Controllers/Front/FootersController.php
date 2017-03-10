<?php namespace Arcanesoft\Seo\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Arcanesoft\Seo\Models\Footer;

/**
 * Class     FootersController
 *
 * @package  Arcanesoft\Seo\Http\Controllers\Front
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FootersController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    public function show(Footer $footer)
    {
        $footer->load(['seo']);

        $this->setTitle($footer->seo->title);
        $this->addBreadcrumb($footer->seo->title);

        return $this->view('seo::public.footer-page', compact('footer'));
    }
}
