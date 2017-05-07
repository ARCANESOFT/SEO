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
        $this->registerProviders([
            Providers\AuthorizationServiceProvider::class,
            Providers\PackagesServiceProvider::class,
            Providers\RouteServiceProvider::class,
            Providers\ViewComposerServiceProvider::class,
        ]);

        $this->registerConsoleServiceProvider(Providers\CommandServiceProvider::class);
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        parent::boot();

        // Publishes
        $this->publishConfig();
        $this->publishViews();
        $this->publishTranslations();
        $this->publishSidebarItems();
        $this->publishAssets();

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

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Publish the assets.
     */
    private function publishAssets()
    {
        $this->publishes([
            $this->getResourcesPath().DS.'assets'.DS => resource_path("assets/_{$this->vendor}/{$this->package}"),
        ], 'assets');
    }
}
