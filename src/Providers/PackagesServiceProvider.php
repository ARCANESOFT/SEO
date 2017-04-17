<?php namespace Arcanesoft\Seo\Providers;

use Arcanedev\LaravelApiHelper\ApiHelperServiceProvider;
use Arcanedev\LaravelSeo\LaravelSeoServiceProvider;
use Arcanedev\LaravelSeo\Seo;
use Arcanedev\SpamBlocker\SpamBlockerServiceProvider;
use Arcanedev\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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

        $this->app->booting(function () {
            Seo::setConfig('database', config('arcanesoft.seo.database'));
            Seo::setConfig('metas', config('arcanesoft.seo.metas'));
            Seo::setConfig('redirects', config('arcanesoft.seo.redirects'));
            Seo::setConfig('redirector.default', 'eloquent');

            Relation::morphMap(config('arcanesoft.seo.morph-map'));
        });
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
