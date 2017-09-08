<?php namespace Arcanesoft\Seo\Tests;

use Arcanesoft\Seo\SeoServiceProvider;

/**
 * Class     SeoServiceProviderTest
 *
 * @package  Arcanesoft\Seo\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoServiceProviderTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var SeoServiceProvider */
    protected $provider;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(SeoServiceProvider::class);
    }

    public function tearDown()
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            \Arcanedev\Support\ServiceProvider::class,
            \Arcanedev\Support\PackageServiceProvider::class,
            \Arcanesoft\Core\Bases\PackageServiceProvider::class,
            \Arcanesoft\Seo\SeoServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_provides()
    {
        $expected = [
            //
        ];

        $this->assertEquals($expected, $this->provider->provides());
    }
}
