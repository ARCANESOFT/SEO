<?php

declare(strict_types=1);

namespace Arcanesoft\Seo;

/**
 * Class     Seo
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Seo
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  bool */
    public static $runsMigrations = true;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  string  $name
     *
     * @return string
     */
    public static function table(string $name, string $default = null, bool $prefixed = true): string
    {
        $name = static::config("database.tables.{$name}", $default);

        return $prefixed ? static::prefixTable($name) : $name;
    }

    /**
     * Add the auth prefix to the table.
     *
     * @param  string  $name
     *
     * @return string
     */
    public static function prefixTable(string $name): string
    {
        $prefix = static::config('database.prefix');

        return $prefix ? $prefix.$name : $name;
    }

    /**
     * Get the model class by the given key.
     *
     * @param  string       $name
     * @param  string|null  $default
     *
     * @return string
     */
    public static function model(string $name, string $default = null): string
    {
        // TODO: Throw exception if not found ?

        return static::config("database.models.{$name}", $default);
    }

    /**
     * Get a config value of this module.
     *
     * @param  string|null  $key
     * @param  mixed|null   $default
     *
     * @return mixed
     */
    public static function config(string $key = null, $default = null)
    {
        $key = is_null($key) ? 'arcanesoft.seo' : "arcanesoft.seo.{$key}";

        return config()->get($key, $default);
    }
}
