<?php namespace Arcanesoft\Seo\Seeds;

use Arcanesoft\Auth\Seeds\PermissionsSeeder;
use Arcanesoft\Seo\Policies\FootersPolicy;
use Arcanesoft\Seo\Policies\DashboardPolicy;
use Arcanesoft\Seo\Policies\MetasPolicy;
use Arcanesoft\Seo\Policies\PagesPolicy;
use Arcanesoft\Seo\Policies\RedirectsPolicy;

/**
 * Class     PermissionsTableSeeder
 *
 * @package  Arcanesoft\Seo\Seeds
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsTableSeeder extends PermissionsSeeder
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
                'group'       => [
                    'name'        => 'SEO',
                    'slug'        => 'seo',
                    'description' => 'SEO permissions group',
                ],
                'permissions' => array_merge(
                    $this->getDashboardSeeds(),
                    $this->getPagesSeeds(),
                    $this->getFootersSeeds(),
                    $this->getMetasSeeds(),
                    $this->getRedirectsSeeds()
                ),
            ],
        ]);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the dashboard permissions
     *
     * @return array
     */
    private function getDashboardSeeds()
    {
        return [
            [
                'name'        => 'Statistics - Show all the stats',
                'description' => 'Show all the SEO stats.',
                'slug'        => DashboardPolicy::PERMISSION_STATS,
            ],
        ];
    }

    /**
     * Get the Pages permissions.
     *
     * @return array
     */
    private function getPagesSeeds()
    {
        return [
            [
                'name'        => 'Pages - List all pages',
                'description' => 'Allow to list all pages.',
                'slug'        => PagesPolicy::PERMISSION_LIST,
            ],
            [
                'name'        => 'Pages - View a page',
                'description' => 'Allow to display a page.',
                'slug'        => PagesPolicy::PERMISSION_SHOW,
            ],
            [
                'name'        => 'Pages - Create a page',
                'description' => 'Allow to create a page.',
                'slug'        => PagesPolicy::PERMISSION_CREATE,
            ],
            [
                'name'        => 'Pages - Update a page',
                'description' => 'Allow to update a page.',
                'slug'        => PagesPolicy::PERMISSION_UPDATE,
            ],
            [
                'name'        => 'Pages - Delete a page',
                'description' => 'Allow to delete a page.',
                'slug'        => PagesPolicy::PERMISSION_DELETE,
            ],
        ];
    }

    /**
     * Get the Footers permissions.
     *
     * @return array
     */
    private function getFootersSeeds()
    {
        return [
            [
                'name'        => 'Footers - List all footers',
                'description' => 'Allow to list all footers.',
                'slug'        => FootersPolicy::PERMISSION_LIST,
            ],
            [
                'name'        => 'Footers - View a footer',
                'description' => 'Allow to display a footer.',
                'slug'        => FootersPolicy::PERMISSION_SHOW,
            ],
            [
                'name'        => 'Footers - Create a footer',
                'description' => 'Allow to create a footer.',
                'slug'        => FootersPolicy::PERMISSION_CREATE,
            ],
            [
                'name'        => 'Footers - Update a footer',
                'description' => 'Allow to update a footer.',
                'slug'        => FootersPolicy::PERMISSION_UPDATE,
            ],
            [
                'name'        => 'Footers - Delete a footer',
                'description' => 'Allow to delete a footer.',
                'slug'        => FootersPolicy::PERMISSION_DELETE,
            ],
        ];
    }

    /**
     * Get the Metas permissions.
     *
     * @return array
     */
    private function getMetasSeeds()
    {
        return [
            [
                'name'        => 'Metas - List a metas',
                'description' => 'Allow to list all metas.',
                'slug'        => MetasPolicy::PERMISSION_LIST,
            ],
        ];
    }

    /**
     * Get the Redirects permissions.
     *
     * @return array
     */
    private function getRedirectsSeeds()
    {
        return [
            [
                'name'        => 'Redirects - List all redirections',
                'description' => 'Allow to list all redirections.',
                'slug'        => RedirectsPolicy::PERMISSION_LIST,
            ],
            [
                'name'        => 'Redirects - View a redirection',
                'description' => 'Allow to display a redirection.',
                'slug'        => RedirectsPolicy::PERMISSION_SHOW,
            ],
            [
                'name'        => 'Redirects - Create a redirection',
                'description' => 'Allow to create a redirection.',
                'slug'        => RedirectsPolicy::PERMISSION_CREATE,
            ],
            [
                'name'        => 'Redirects - Update a redirection',
                'description' => 'Allow to update a redirection.',
                'slug'        => RedirectsPolicy::PERMISSION_UPDATE,
            ],
            [
                'name'        => 'Redirects - Delete a redirection',
                'description' => 'Allow to delete a redirection.',
                'slug'        => RedirectsPolicy::PERMISSION_DELETE,
            ],
        ];
    }
}
