<?php namespace Arcanesoft\Seo\Http\Middleware;

use Arcanedev\SpamBlocker\Contracts\SpamBlocker;
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
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var  \Arcanedev\SpamBlocker\Contracts\SpamBlocker */
    protected $blocker;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct(SpamBlocker $blocker)
    {
        $this->blocker = $blocker;
    }

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
        if ($this->blocker->isBlocked($request->headers->get('referer'))) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
