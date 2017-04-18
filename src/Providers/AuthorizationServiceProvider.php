<?php namespace Arcanesoft\Seo\Providers;

use Arcanedev\Support\Providers\AuthorizationServiceProvider as ServiceProvider;
use Arcanesoft\Seo\Policies\DashboardPolicy;
use Arcanesoft\Seo\Policies\FootersPolicy;
use Arcanesoft\Seo\Policies\MetasPolicy;
use Arcanesoft\Seo\Policies\PagesPolicy;
use Arcanesoft\Seo\Policies\RedirectsPolicy;

/**
 * Class AuthorizationServiceProvider
 *
 * @package  Arcanesoft\Seo\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthorizationServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any application authentication / authorization services.
     */
    public function boot()
    {
        parent::registerPolicies();

        $this->defineMany(DashboardPolicy::class, DashboardPolicy::policies());
        $this->defineMany(PagesPolicy::class,     PagesPolicy::policies());
        $this->defineMany(FootersPolicy::class,   FootersPolicy::policies());
        $this->defineMany(MetasPolicy::class,     MetasPolicy::policies());
        $this->defineMany(RedirectsPolicy::class, RedirectsPolicy::policies());
    }
}
