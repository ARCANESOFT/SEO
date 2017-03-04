<?php

use Arcanesoft\Auth\Models\Role;

return [
    'title'       => 'SEO',
    'name'        => 'seo',
    'icon'        => 'fa fa-fw fa-globe',
    'roles'       => [Role::ADMINISTRATOR],
    'permissions' => [],
    'children'    => [
        [
            'title'       => 'Statistics',
            'name'        => 'seo-dashboard',
            'route'       => 'admin::seo.stats.index',
            'icon'        => 'fa fa-fw fa-bar-chart',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
//                Policies\DashboardPolicy::PERMISSION_STATS
            ],
        ],
        [
            'title'       => 'Metas',
            'name'        => 'seo-metas',
            'route'       => 'admin::seo.metas.index',
            'icon'        => 'fa fa-fw fa-tags',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
                //
            ],
        ],
        [
            'title'       => 'Redirections',
            'name'        => 'seo-redirects',
            'route'       => 'admin::seo.redirects.index',
            'icon'        => 'fa fa-fw fa-random',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
                //
            ],
        ],
        [
            'title'       => 'Spammers',
            'name'        => 'seo-spammers',
            'route'       => 'admin::seo.spammers.index',
            'icon'        => 'fa fa-fw fa-ban',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
                //
            ],
        ],
    ],
];
