<?php

return [

    /* -----------------------------------------------------------------
     |  Attributes
     | -----------------------------------------------------------------
     */

    'attributes' => [
        'old_url' => 'Ancienne URL',
        'new_url' => 'Nouvelle URL',
        'status'  => 'Status',
    ],

    /* -----------------------------------------------------------------
     |  Titles
     | -----------------------------------------------------------------
     */

    'titles' => [
        'redirections'        => 'Redirections',
        'redirections-list'   => 'Liste des redirections',
        'new-redirection'     => 'Nouvelle redirection',
        'create-redirection'  => 'Créer une redirection',
        'redirection-details' => 'Détails de redirection',
        'edit-redirection'    => 'Modifier la redirection',
        'update-redirection'  => 'Mettre à jour la redirection',
    ],

    /* -----------------------------------------------------------------
     |  Messages
     | -----------------------------------------------------------------
     */

    'list-empty' => 'La liste des redirections est vide !',

    'messages' => [
        'created' => [
            'title'   => 'Redirection créée !',
            'message' => 'La redirection a été créée avec succès !',
        ],

        'updated' => [
            'title'   => 'Redirection modifiée !',
            'message' => 'La redirection a été modifiée avec succès !',
        ],

        'deleted' => [
            'title'   => 'Redirection supprimée !',
            'message' => 'La redirection a été supprimée avec succès !',
        ],
    ],

    /* -----------------------------------------------------------------
     |  Modals
     | -----------------------------------------------------------------
     */

    'modals' => [
        'delete' => [
            'title'   => 'Supprimer redirection',
            'message' => 'Êtes-vous sûr de vouloir <span class="label label-danger">supprimer</span> cette redirection ?',
        ],
    ],
];
