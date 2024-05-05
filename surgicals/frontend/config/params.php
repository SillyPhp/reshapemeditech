<?php
return [
    'adminEmail' => 'admin@example.com',
    'upload_directories' => [
        'blogs' => [
            'image' => DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'blogs' . DIRECTORY_SEPARATOR,
            'image_path' => dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'blogs'.DIRECTORY_SEPARATOR,
        ],
        'services' => [
            'image' => DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR,
            'image_path' => dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'services'.DIRECTORY_SEPARATOR,
        ],
        'products' => [
            'image' => DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR,
            'image_path' => dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'products'.DIRECTORY_SEPARATOR,
        ],
        'clients' => [
            'image' => DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'clients' . DIRECTORY_SEPARATOR,
            'image_path' => dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'clients'.DIRECTORY_SEPARATOR,
        ],
        'teams' => [
            'image' => DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'teams' . DIRECTORY_SEPARATOR,
            'image_path' => dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'teams'.DIRECTORY_SEPARATOR,
        ],
        'videos' => [
            'image' =>  'images' . DIRECTORY_SEPARATOR . 'videos' . DIRECTORY_SEPARATOR,
            'image_path' => dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'videos'.DIRECTORY_SEPARATOR,
        ]
        ]
];
