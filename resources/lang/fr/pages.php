<?php

return [

    /* -----------------------------------------------------------------
     |  Attributes
     | -----------------------------------------------------------------
     */

    'attributes' => [
        'locale'     => 'Langue',
        'name'       => 'Nom',
        'content'    => 'Contenu',
        'shortcodes' => 'Shortcodes',
    ],

    /* -----------------------------------------------------------------
     |  Titles
     | -----------------------------------------------------------------
     */

    'titles' => [
        'pages'        => 'Pages',
        'pages-list'   => 'Liste des pages',
        'create-page'  => 'Créer une page',
        'new-page'     => 'Nouvelle Page',
        'edit-page'    => 'Modifier une page',
        'update-page'  => 'Mettre à jour une page',
        'page-details' => 'Détails de la page',
    ],

    /* -----------------------------------------------------------------
     |  Messages
     | -----------------------------------------------------------------
     */

    'list-empty'     => 'La liste des pages est vide !',
    'has-no-footers' => "Cette page n'a aucune pieds de page !",

    'messages' => [
        'created' => [
            'title'   => 'Page créée !',
            'message' => 'La page [:name] a été créée avec succès !',
        ],

        'updated' => [
            'title'   => 'Page modifiée !',
            'message' => 'La page [:name] a été modifiée avec succès !',
        ],

        'deleted' => [
            'title'   => 'Page supprimée !',
            'message' => 'La page [:name] a été supprimée avec succès !',
        ],
    ],

    /* -----------------------------------------------------------------
     |  Modals
     | -----------------------------------------------------------------
     */

    'modals' => [
        'delete' => [
            'title'   => 'Supprimer une page',
            'message' => 'Êtes-vous sûr de vouloir <span class="label label-danger">supprimer</span> cette page: <strong>:name</strong> ?',
        ],
    ],

];
