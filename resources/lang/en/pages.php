<?php

return [

    /* -----------------------------------------------------------------
     |  Attributes
     | -----------------------------------------------------------------
     */

    'attributes' => [
        'locale'     => 'Locale',
        'name'       => 'Name',
        'content'    => 'Content',
        'shortcodes' => 'Shortcodes',
    ],

    /* -----------------------------------------------------------------
     |  Titles
     | -----------------------------------------------------------------
     */

    'titles' => [
        'pages'        => 'Pages',
        'pages-list'   => 'List of Pages',
        'create-page'  => 'Create a page',
        'new-page'     => 'New Page',
        'edit-page'    => 'Edit a page',
        'update-page'  => 'Update a page',
        'page-details' => 'Page details',
    ],

    /* -----------------------------------------------------------------
     |  Messages
     | -----------------------------------------------------------------
     */

    'list-empty'     => 'The list of pages is empty !',
    'has-no-footers' => 'This page has no footers !',

    'messages' => [
        'created' => [
            'title'   => 'Page Created !',
            'message' => 'The page [:name] was created successfully !',
        ],

        'updated' => [
            'title'   => 'Page Updated !',
            'message' => 'The page [:name] was updated successfully !',
        ],

        'deleted' => [
            'title'   => 'Page deleted !',
            'message' => 'The page [:name] has been deleted successfully !',
        ],
    ],

    /* -----------------------------------------------------------------
     |  Modals
     | -----------------------------------------------------------------
     */

    'modals' => [
        'delete' => [
            'title'   => 'Delete Page',
            'message' => 'Are you sure you want to <span class="label label-danger">delete</span> this page: <strong>:name</strong> ?',
        ]
    ],

];
