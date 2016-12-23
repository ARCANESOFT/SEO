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
    ],
];
