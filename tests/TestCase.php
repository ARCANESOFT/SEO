<?php namespace Arcanesoft\Seo\Tests;

use Arcanesoft\Auth\AuthServiceProvider;
use Orchestra\Testbench\BrowserKit\TestCase as BaseTestCase;

/**
 * Class     TestCase
 *
 * @package  Arcanesoft\Seo\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TestCase extends BaseTestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Arcanesoft\Auth\AuthServiceProvider::class,
            \Arcanesoft\Seo\SeoServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            //
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set(
            'spam-blocker.source',
            realpath(__DIR__ . '/../vendor/piwik/referrer-spam-blacklist/spammers.txt')
        );

        $this->setUpRoutes($app);
    }

    /**
     * Setup routes.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    private function setUpRoutes($app)
    {
        /** @var  \Orchestra\Testbench\Http\Kernel  $httpKernel */
        $httpKernel = $app->make('Illuminate\Contracts\Http\Kernel');
        $httpKernel->pushMiddleware(\Arcanesoft\Seo\Http\Middleware\SeoSpamBlockerMiddleware::class);

        $app['router']->get('/', function () {
            return 'Home page';
        });
    }
}
