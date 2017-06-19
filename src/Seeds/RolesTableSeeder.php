<?php namespace Arcanesoft\Seo\Seeds;

use Arcanesoft\Auth\Seeds\RolesSeeder;

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
}
