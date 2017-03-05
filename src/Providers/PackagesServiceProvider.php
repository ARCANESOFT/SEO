<?php namespace Arcanesoft\Seo\Providers;

use Arcanedev\LaravelApiHelper\ApiHelperServiceProvider;
use Arcanedev\LaravelSeo\LaravelSeoServiceProvider;
use Arcanedev\SpamBlocker\SpamBlockerServiceProvider;
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

        $this->registerLaravelSeoPackage();
        $this->registerSpamBlockerPackage();
        $this->registerApiHelperPackage();
    }

    /* -----------------------------------------------------------------
     |  Packages
     | -----------------------------------------------------------------
     */
    /**
     * Register Laravel Seo package.
     */
    private function registerLaravelSeoPackage()
    {
        $this->registerProvider(LaravelSeoServiceProvider::class);
    }

    /**
     * Register Spam Blocker package.
     */
    private function registerSpamBlockerPackage()
    {
        $this->registerProvider(SpamBlockerServiceProvider::class);
    }

    /**
     * Register API Helper package.
     */
    private function registerApiHelperPackage()
    {
        $this->registerProvider(ApiHelperServiceProvider::class);
    }
}
