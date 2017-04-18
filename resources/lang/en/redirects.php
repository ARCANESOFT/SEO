<?php

return [

    /* -----------------------------------------------------------------
     |  Attributes
     | -----------------------------------------------------------------
     */

    'attributes' => [
        'old_url' => 'Old URL',
        'new_url' => 'New URL',
        'status'  => 'Status',
    ],

    /* -----------------------------------------------------------------
     |  Titles
     | -----------------------------------------------------------------
     */

    'titles' => [
        'redirections'        => 'Redirections',
        'redirections-list'   => 'List of Redirections',
        'new-redirection'     => 'New Redirection',
        'create-redirection'  => 'Create Redirection',
        'redirection-details' => 'Redirection details',
        'edit-redirection'    => 'Edit Redirection',
        'update-redirection'  => 'Update Redirection',
    ],

    /* -----------------------------------------------------------------
     |  Messages
     | -----------------------------------------------------------------
     */

    'list-empty' => 'The list of redirections is empty !',

    'messages' => [
        'created' => [
            'title'   => 'Redirection Created !',
            'message' => 'The redirection was created successfully !',
        ],

        'updated' => [
            'title'   => 'Redirection Updated !',
            'message' => 'The redirection was updated successfully !',
        ],

        'deleted' => [
            'title'   => 'Redirection Deleted !',
            'message' => 'The redirection was deleted successfully !',
        ],
    ],

    /* -----------------------------------------------------------------
     |  Modals
     | -----------------------------------------------------------------
     */

    'modals' => [
        'delete' => [
            'title'   => 'Delete Redirection',
            'message' => 'Are you sure you want to <span class="label label-danger">delete</span> this redirection ?',
        ],
    ],
];
