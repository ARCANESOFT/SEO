<?php namespace Arcanesoft\Seo;

use Arcanesoft\Core\Bases\PackageServiceProvider;
use Arcanesoft\Core\CoreServiceProvider;

/**
 * Class     AuthServiceProvider
 *
 * @package  Arcanesoft\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoServiceProvider extends PackageServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Package name.
     *
     * @var string
     */
    protected $package      = 'seo';

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the base path of the package.
     *
     * @return string
     */
    public function getBasePath()
    {
        return dirname(__DIR__);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();
        $this->app->register(CoreServiceProvider::class);

        $this->registerHelpers();
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->registerPublishes();
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

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the helpers.
     */
    private function registerHelpers()
    {
        $this->singleton('arcanesoft.seo.spammers', function () {
            return new Helpers\Spammers(
                $this->config()->get('arcanesoft.seo.spammers')
            );
        });
    }

    /**
     * Register publishes.
     */
    private function registerPublishes()
    {
        // Config
        $this->publishes([
            $this->getConfigFile() => config_path("{$this->vendor}/{$this->package}.php"),
        ], 'config');

        // Views
        $viewsPath = $this->getBasePath() . '/resources/views';
        $this->loadViewsFrom($viewsPath, 'seo');
        $this->publishes([
            $viewsPath => base_path('resources/views/vendor/seo'),
        ], 'views');

        // Translations
        $translationsPath = $this->getBasePath() . '/resources/lang';
        $this->loadTranslationsFrom($translationsPath, 'seo');
        $this->publishes([
            $translationsPath => base_path('resources/lang/vendor/seo'),
        ], 'lang');
    }
}
