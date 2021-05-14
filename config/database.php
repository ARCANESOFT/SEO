<?php

return [

    /* -----------------------------------------------------------------
     |  Connections
     | -----------------------------------------------------------------
     */

    'connection' => env('DB_CONNECTION', 'mysql'),

    /* -----------------------------------------------------------------
     |  Tables
     | -----------------------------------------------------------------
     */

    'prefix'     => 'seo_',

    'tables' => [
        'footers' => 'footers',
        'pages'   => 'pages',
        'metas'   => 'metas',
    ],

    /* -----------------------------------------------------------------
     |  Models
     | -----------------------------------------------------------------
     */

    'models' => [
        'page'   => Arcanesoft\Seo\Models\Page::class,
        'footer' => Arcanesoft\Seo\Models\Footer::class,
        'meta'   => Arcanesoft\Seo\Models\Meta::class,
    ],

];
