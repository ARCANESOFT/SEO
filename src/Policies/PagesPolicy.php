<?php namespace Arcanesoft\Seo\Policies;

use Arcanesoft\Contracts\Auth\Models\User;

/**
 * Class PagesPolicy
 *
 * @package  Arcanesoft\Seo\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PagesPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const PERMISSION_LIST   = 'seo.pages.list';
    const PERMISSION_SHOW   = 'seo.pages.show';
    const PERMISSION_CREATE = 'seo.pages.create';
    const PERMISSION_UPDATE = 'seo.pages.update';
    const PERMISSION_DELETE = 'seo.pages.delete';

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the pages.
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
     * Allow to show a page details.
     *
     * @param  \Arcanesoft\Contracts\Auth\Models\User  $user
     *
     * @return bool
     */
    public function showPolicy(User $user)
    {
        return $user->may(static::PERMISSION_SHOW);
    }

    /**
     * Allow to create a page.
     *
     * @param  \Arcanesoft\Contracts\Auth\Models\User  $user
     *
     * @return bool
     */
    public function createPolicy(User $user)
    {
        return $user->may(static::PERMISSION_CREATE);
    }

    /**
     * Allow to update a page.
     *
     * @param  \Arcanesoft\Contracts\Auth\Models\User  $user
     *
     * @return bool
     */
    public function updatePolicy(User $user)
    {
        return $user->may(static::PERMISSION_UPDATE);
    }

    /**
     * Allow to delete a page.
     *
     * @param  \Arcanesoft\Contracts\Auth\Models\User  $user
     *
     * @return bool
     */
    public function deletePolicy(User $user)
    {
        return $user->may(static::PERMISSION_DELETE);
    }
}
