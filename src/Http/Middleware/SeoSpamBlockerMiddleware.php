<?php namespace Arcanesoft\Seo\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class     SeoSpamBlockerMiddleware
 *
 * @package  Arcanesoft\Seo\Http\Middleware
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoSpamBlockerMiddleware
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $spammers = app('arcanesoft.seo.spammers');

        if ($spammers->isSpamRequest($request)) {
            return response('Spam referral.', 401);
        }

        return $next($request);
    }
}
