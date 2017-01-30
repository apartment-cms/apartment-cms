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
        'ListPage' => [
            'content' => [
                'type' => 'text',
            ],
            'bucket' => [
                'type' => 'relationship',
                'model' => 'ApartmentCMS\ApartmentCMS\Models\Bucket',
                'label' => 'name',
                'value' => 'id',
                'relationship' => 'bucket_id'
            ],
        ],
        'bucket' => [
            'name' => [
                'type' => 'string'
            ],
            'slug' => [
                'type' => 'string',
            ],
            'contains' => [
                'type' => 'string',
            ],
        ],
        'dataItem' => [
            'name' => [
                'type' => 'string'
            ],
            'slug' => [
                'type' => 'string',
            ],
            'content' => [
                'type' => 'text',
            ],
        ]
    ]
];