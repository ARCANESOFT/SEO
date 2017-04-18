<?php namespace Arcanesoft\Seo\Entities;

use Illuminate\Support\Collection;

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
        return new Collection(trans("seo::locales"));
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
        return static::all()->get($key, $default);
    }
}
