<?php namespace Arcanesoft\Seo\ViewComposers\Front;

use Arcanesoft\Seo\Models\Footer;
use Arcanesoft\Seo\ViewComposers\ViewComposer;
use Illuminate\Contracts\View\View;

/**
 * Class     FooterWidgetComposer
 *
 * @package  Arcanesoft\Seo\ViewComposers\Front
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FooterWidgetComposer extends ViewComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */
    const VIEW = 'seo::public._composers.widgets.footer-widget';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Compose the view.
     *
     * @param  \Illuminate\Contracts\View\View  $view
     */
    public function compose(View $view)
    {
        $this->view = $view;

        $this->view->with('seoFooters', Footer::all());
    }
}
