<?php namespace Arcanesoft\Seo\Providers;

use Arcanedev\Support\Providers\ViewComposerServiceProvider as ServiceProvider;

use Arcanesoft\Seo\ViewComposers\Front\FooterWidgetComposer;

/**
 * Class     ViewComposerServiceProvider
 *
 * @package  Arcanesoft\Seo\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ViewComposerServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the composer classes.
     *
     * @var array
     */
    protected $composerClasses = [
        // Dashboard view composers


        // Public view composers (Widgets)
        FooterWidgetComposer::VIEW => FooterWidgetComposer::class,
    ];
}
