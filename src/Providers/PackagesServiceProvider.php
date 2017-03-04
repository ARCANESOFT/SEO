<?php namespace Arcanesoft\Seo\Providers;

use Arcanedev\Support\ServiceProvider;

/**
 * Class     PackagesServiceProvider
 *
 * @package  Arcanesoft\Seo\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PackagesServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        parent::register();

        $this->registerProviders([
            \Arcanedev\LaravelSeo\LaravelSeoServiceProvider::class,
            \Arcanedev\SpamBlocker\SpamBlockerServiceProvider::class,
        ]);
    }
}
