<?php

use Arcanesoft\Auth\Models\Role;
use Arcanesoft\Seo\Policies;

return [
    'title'       => 'seo::sidebar.seo',
    'name'        => 'seo',
    'icon'        => 'fa fa-fw fa-globe',
    'roles'       => [Role::ADMINISTRATOR],
    'permissions' => [],
    'children'    => [
        [
            'title'       => 'seo::sidebar.statistics',
            'name'        => 'seo-dashboard',
            'route'       => 'admin::seo.stats.index',
            'icon'        => 'fa fa-fw fa-bar-chart',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
                Policies\DashboardPolicy::PERMISSION_STATS,
            ],
        ],
        [
            'title'       => 'seo::sidebar.metas',
            'name'        => 'seo-metas',
            'route'       => 'admin::seo.metas.index',
            'icon'        => 'fa fa-fw fa-tags',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
                Policies\MetasPolicy::PERMISSION_LIST,
            ],
        ],
        [
            'title'       => 'seo::sidebar.footers',
            'name'        => 'seo-footers',
            'route'       => 'admin::seo.footers.index',
            'icon'        => 'fa fa-fw fa-th',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
                Policies\FootersPolicy::PERMISSION_LIST,
            ],
        ],
        [
            'title'       => 'seo::sidebar.pages',
            'name'        => 'seo-pages',
            'route'       => 'admin::seo.pages.index',
            'icon'        => 'fa fa-fw fa-files-o',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
                Policies\PagesPolicy::PERMISSION_LIST,
            ],
        ],
        [
            'title'       => 'seo::sidebar.redirections',
            'name'        => 'seo-redirects',
            'route'       => 'admin::seo.redirects.index',
            'icon'        => 'fa fa-fw fa-random',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
                //
            ],
        ],
        [
            'title'       => 'seo::sidebar.spammers',
            'name'        => 'seo-spammers',
            'route'       => 'admin::seo.spammers.index',
            'icon'        => 'fa fa-fw fa-ban',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
                //
            ],
        ],
        [
            'title'       => 'seo::sidebar.settings',
            'name'        => 'seo-settings',
            'route'       => 'admin::seo.settings.index',
            'icon'        => 'fa fa-fw fa-cog',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
                //
            ],
        ],
    ],
];
