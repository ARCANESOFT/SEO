<?php namespace Arcanesoft\Seo\Entities;

/**
 * Class     Locales
 *
 * @package  Arcanesoft\Seo\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Locales
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Get all the supported locales.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function all()
    {
        $locales = config('arcanesoft.seo.locales', []);

        return collect(array_combine($locales, $locales))->transform(function ($locale) {
            return trans("seo::locales.$locale");
        });
    }

    /**
     * Get all the supported locales keys.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function keys()
    {
        return static::all()->keys();
    }

    /**
     * Get a supported locale by its key.
     *
     * @param  string       $key
     * @param  string|null  $default
     *
     * @return string|null
     */
    public static function get($key, $default = null)
    {
        return static::all()->get($key);
    }
}
