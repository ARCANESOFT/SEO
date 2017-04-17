<?php

return [

    /* -----------------------------------------------------------------
     |  Attributes
     | -----------------------------------------------------------------
     */

    'attributes' => [
        'locale'       => 'Locale',
        'name'         => 'Name',
        'localization' => 'Localization',
        'uri'          => 'URI',
        'page'         => 'Page',
    ],

    /* -----------------------------------------------------------------
     |  Titles
     | -----------------------------------------------------------------
     */

    'titles' => [
        'footers'        => 'Footers',
        'footers-list'   => 'List of Footers',
        'create-footer'  => 'Create a footer',
        'new-footer'     => 'New Footer',
        'edit-footer'    => 'Edit a footer',
        'update-footer'  => 'Update a footer',
        'footer-details' => 'Footer details',
    ],

    /* -----------------------------------------------------------------
     |  Messages
     | -----------------------------------------------------------------
     */

    'list-empty' => 'The list of footers is empty !',

    'messages' => [
        'created' => [
            'title'   => 'Footer Created !',
            'message' => 'The footer [:name] was created successfully !',
        ],

        'updated' => [
            'title'   => 'Footer Updated !',
            'message' => 'The footer [:name] was updated successfully !',
        ],

        'deleted' => [
            'title'   => 'Footer Deleted !',
            'message' => 'The footer [:name] has been deleted successfully !',
        ],
    ],

    /* -----------------------------------------------------------------
     |  Modals
     | -----------------------------------------------------------------
     */

    'modals' => [
        'delete' => [
            'title'   => 'Delete Footer',
            'message' => 'Are you sure you want to <span class="label label-danger">delete</span> this footer: <strong>:name</strong> ?',
        ]
    ],

];
