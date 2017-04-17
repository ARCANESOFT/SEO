<?php

return [

    /* -----------------------------------------------------------------
     |  Attributes
     | -----------------------------------------------------------------
     */

    'attributes' => [
        'locale'       => 'Langue',
        'name'         => 'Nom',
        'localization' => 'Localisation',
        'uri'          => 'URI',
        'page'         => 'Page',
    ],

    /* -----------------------------------------------------------------
     |  Titles
     | -----------------------------------------------------------------
     */

    'titles' => [
        'footers'        => 'Pieds de page',
        'footers-list'   => 'Liste des pieds de page',
        'create-footer'  => 'Create a pied de page',
        'new-footer'     => 'Nouveau pied de page',
        'edit-footer'    => 'Modifier pied de page',
        'update-footer'  => 'Mettre à jour pied de page',
        'footer-details' => 'Détails sur le pied de page',
    ],

    /* -----------------------------------------------------------------
     |  Messages
     | -----------------------------------------------------------------
     */

    'list-empty' => 'La liste des pieds de page est vide !',

    'messages' => [
        'created' => [
            'title'   => 'Pieds de page créé !',
            'message' => 'Le pied de page [:name] a été créé avec succès !',
        ],

        'updated' => [
            'title'   => 'Pieds de page modifié !',
            'message' => 'Le pied de page [:name] a été modifié avec succès !',
        ],

        'deleted' => [
            'title'   => 'Pieds de page supprimé !',
            'message' => 'Le pied de page [:name] a été supprimé avec succès !',
        ],
    ],

    /* -----------------------------------------------------------------
     |  Modals
     | -----------------------------------------------------------------
     */

    'modals' => [
        'delete' => [
            'title'   => 'Supprimer le pied de page',
            'message' => 'Êtes-vous sûr de vouloir <span class="label label-danger">supprimer</span> ce pied de page: <strong>:name</strong> ?',
        ]
    ],

];
