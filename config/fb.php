<?php

return [
    'project' => [
        'path' => storage_path('fb/projects'),
        'logo' => [
            'name' => 'logo',
            'subPath' => '',
            'width' => 200,
            'height' => 200
        ],
        'image' => [
            'subPaths' => [
                'base' => 'images',
                'thumb' => 'images/thumbs'
            ],
            'sizes' => [
                'base' => [
                    'width' => 594,
                    'height' => 400
                ],
                'big' => [
                    'width' => 1000,
                    'height' => 673
                ],
                'thumb' => [
                    'width' => 200,
                    'height' => 200
                ]
            ]
        ]
    ],
    'site' => [
        'favicon' => [
            'path' => public_path('favicon')
        ],
        'banner' => [
            'path' => public_path('images/banner')
        ]
    ],
    'page' => [
        'path' => storage_path('fb/pages'),
        'logo' => [
            'name' => 'logo',
            'subPath' => '',
            'width' => 200,
            'height' => 200
        ],
    ],

];
