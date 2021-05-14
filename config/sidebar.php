<?php

return [

    /* -----------------------------------------------------------------
     |  Sidebar's items
     | -----------------------------------------------------------------
     */

    'items' => [
        [
            'name'        => 'seo::main',
            'title'       => 'SEO',
            'icon'        => 'fas fa-fw fa-seo',
            'roles'       => [],
            'permissions' => [],
            'children'    => [
                [
                    'name'        => 'seo::main.dashboard',
                    'title'       => 'Statistics',
                    'icon'        => 'fa fa-fw fa-tachometer-alt',
                    'route'       => Arcanesoft\Seo\Http\Routes\DashboardRoutes::ROUTE_INDEX,
                    'roles'       => [
                        'seo-author',
                        'seo-moderator',
                    ],
                    'permissions' => [
                        'admin::seo.statistics.index',
                    ],
                ],
                [
                    'name'        => 'seo::main.pages',
                    'title'       => 'Pages',
                    'icon'        => 'far fa-fw fa-newspaper',
                    'route'       => Arcanesoft\Seo\Http\Routes\PagesRoutes::ROUTE_INDEX,
                    'roles'       => [
                        'seo-author',
                        'seo-moderator',
                    ],
                    'permissions' => [
                        'admin::seo.pages.index',
                    ],
                ],
                [
                    'name'        => 'seo::main.footers',
                    'title'       => 'Footers',
                    'icon'        => 'fas fa-fw fa-footers',
                    'route'       => Arcanesoft\Seo\Http\Routes\FootersRoutes::ROUTE_INDEX,
                    'roles'       => [
                        'seo-author',
                        'seo-moderator',
                    ],
                    'permissions' => [
                        'admin::seo.footers.index',
                    ],
                ],
                [
                    'name'        => 'seo::main.metas',
                    'title'       => 'Metas',
                    'icon'        => 'fas fa-fw fa-footers',
                    'route'       => Arcanesoft\Seo\Http\Routes\MetasRoutes::ROUTE_INDEX,
                    'roles'       => [
                        'seo-author',
                        'seo-moderator',
                    ],
                    'permissions' => [
                        'admin::seo.metas.index',
                    ],
                ],
            ],
        ],
    ],

];
