<?php

return [
    'project' => [
        'image' => [
            'paths' => [
                'base' => storage_path('fb/projects/images'),
                'thumb' => storage_path('fb/projects/images/thumbs')
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
    ]

];
