<?php namespace Arcanesoft\Seo\Tests\Entities;

use Arcanesoft\Seo\Entities\Locales;
use Arcanesoft\Seo\Tests\TestCase;

/**
 * Class     LocalesTest
 *
 * @package  Arcanesoft\Seo\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LocalesTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_get_all_the_locales()
    {
        $locales = Locales::all();

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $locales);
        $this->assertCount(2, $locales);

        $expected = [
            'en' => 'English',
            'fr' => 'French',
        ];

        $this->assertSame($expected, $locales->toArray());
    }

    /** @test */
    public function it_can_get_only_keys()
    {
        $keys = Locales::keys();

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $keys);
        $this->assertCount(2, $keys);

        $this->assertSame(['en', 'fr'], $keys->toArray());
    }

    /** @test */
    public function it_can_get_single_locale()
    {
        $expectations = [
            'en' => 'English',
            'fr' => 'French',
        ];

        foreach ($expectations as $locale => $expected) {
            $this->assertSame($expected, Locales::get($locale));
        }
    }

    /** @test */
    public function it_can_get_translated_locale()
    {
        $this->app->setLocale('fr');

        $expectations = [
            'en' => 'Anglais',
            'fr' => 'Français',
        ];

        foreach ($expectations as $locale => $expected) {
            $this->assertSame($expected, Locales::get($locale));
        }
    }
}
