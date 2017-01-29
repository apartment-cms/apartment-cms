<?php

/*
|--------------------------------------------------------------------------
| Apartment CMS Config
|--------------------------------------------------------------------------
*/

return [
    'forms' => [
        'generic' => [
           'name' => [
                'type' => 'string'
            ],
            'slug' => [
                'type' => 'string',
            ],
            'template' => [
                'type' => 'relationship',
                'model' => 'ApartmentCMS\ApartmentCMS\Models\Template',
                'label' => 'name',
                'value' => 'id',
                'relationship' => 'template_id'
            ],
        ],
        'Homepage' => [
            'content' => [
                'type' => 'text',
            ],
        ],
        'TextPage' => [
            'content' => [
                'type' => 'text',
            ],
        ],
        'Blog' => [
            'content' => [
                'type' => 'text',
            ],
        ]
    ]
];