<?php namespace Arcanesoft\Seo\Policies;

use Arcanesoft\Contracts\Auth\Models\User;

/**
 * Class     MetasPolicy
 *
 * @package  Arcanesoft\Seo\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetasPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const PERMISSION_LIST   = 'seo.metas.list';
    const PERMISSION_SHOW   = 'seo.metas.show';

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the footers.
     *
     * @param  \Arcanesoft\Contracts\Auth\Models\User  $user
     *
     * @return bool
     */
    public function listPolicy(User $user)
    {
        return $user->may(static::PERMISSION_LIST);
    }

    /**
     * Allow to show a footer details.
     *
     * @param  \Arcanesoft\Contracts\Auth\Models\User  $user
     *
     * @return bool
     */
    public function showPolicy(User $user)
    {
        return $user->may(static::PERMISSION_SHOW);
    }
}
