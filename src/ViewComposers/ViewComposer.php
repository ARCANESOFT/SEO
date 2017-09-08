<?php namespace Arcanesoft\Seo\ViewComposers;

use Closure;
use Illuminate\Support\Facades\Cache;

/**
 * Class     ViewComposer
 *
 * @package  Arcanesoft\Seo\Bases
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ViewComposer
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Caching time.
     *
     * @var int
     */
    protected $minutes = 5;

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Cache the results.
     *
     * @param  string    $name
     * @param  \Closure  $callback
     *
     * @return mixed
     */
    protected function cacheResults($name, Closure $callback)
    {
        return Cache::remember('cache::' . $name, $this->minutes, $callback);
    }
}
