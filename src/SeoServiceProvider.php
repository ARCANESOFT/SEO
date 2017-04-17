<?php namespace Arcanesoft\Seo;

use Arcanesoft\Core\Bases\PackageServiceProvider;

/**
 * Class     SeoServiceProvider
 *
 * @package  Arcanesoft\Seo
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoServiceProvider extends PackageServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'seo';

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

        $this->registerConfig();
        $this->registerSidebarItems();
        $this->registerProvider(Providers\PackagesServiceProvider::class);
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        parent::boot();

        $this->registerProvider(Providers\RouteServiceProvider::class);
        $this->registerProvider(Providers\ViewComposerServiceProvider::class);

        // Publishes
        $this->publishConfig();
        $this->publishViews();
        $this->publishTranslations();
        $this->publishSidebarItems();

        $this->loadMigrations();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            //
        ];
    }
}
