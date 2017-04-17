<?php namespace Arcanesoft\Seo\Seeds;

use Arcanesoft\Auth\Models\Role;
use Arcanesoft\Auth\Models\Permission;
use Arcanesoft\Auth\Seeds\RolesSeeder;
use Illuminate\Support\Str;

/**
 * Class     RolesTableSeeder
 *
 * @package  Arcanesoft\Seo\Seeds
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesTableSeeder extends RolesSeeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->seed([
            [
                'name'        => 'SEO Moderators',
                'description' => 'The SEO moderators role.',
                'is_locked'   => true,
            ],
        ]);

        $this->syncAdminRole();
        $this->syncRoles([
            'seo-moderators' => 'seo.',
        ]);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Sync the roles.
     * @todo: Refactor this method
     *
     * @param  array  $roles
     */
    protected function syncRoles(array $roles)
    {
        $permissions = Permission::all();

        foreach ($roles as $roleSlug => $permissionSlug) {
            $ids  = $permissions->filter(function (Permission $permission) use ($permissionSlug) {
                return Str::startsWith($permission->slug, $permissionSlug);
            })->pluck('id');

            /** @var  \Arcanesoft\Auth\Models\Role  $role */
            if ($role = Role::where('slug', $roleSlug)->first()) {
                $role->permissions()->sync($ids);
            }
        }
    }
}
