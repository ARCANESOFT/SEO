<?php namespace Arcanesoft\Seo\Models;

use Arcanedev\LaravelSeo\Models\Redirect as BaseRedirect;

/**
 * Class     Redirect
 *
 * @package  Arcanesoft\Seo\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Redirect extends BaseRedirect
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create a redirection.
     *
     * @param  array  $attributes
     *
     * @return self
     */
    public static function createRedirect(array $attributes)
    {
        return tap(new static($attributes), function (self $redirect) {
            $redirect->save();
        });
    }
}
