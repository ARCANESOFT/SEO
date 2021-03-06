<?php namespace Arcanesoft\Seo\Policies;

use Arcanesoft\Contracts\Auth\Models\User;

/**
 * Class DashboardPolicy
 *
 * @package  Arcanesoft\Seo\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const PERMISSION_STATS = 'seo.dashboard.stats';

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the statistics.
     *
     * @param  \Arcanesoft\Contracts\Auth\Models\User  $user
     *
     * @return bool
     */
    public function statsPolicy(User $user)
    {
        return $user->may(static::PERMISSION_STATS);
    }
}
