<?php

use yii\helpers\Url;

//$baseUrl = ltrim(Url::base(''),'/');
//if($baseUrl == 'mis.nagpaltelestore.com'){
//
//}
return [
    'site_name' => "Techneyo Project",
    'upload_directories' => [
        'category' => [
            'image' => DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'categories' . DIRECTORY_SEPARATOR,
            'image_path' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'categories' . DIRECTORY_SEPARATOR,
        ],
        'product' => [
            'image' => DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR,
            'image_path' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR,
        ],
        'test' => [
            'image' => DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'test' . DIRECTORY_SEPARATOR,
            'image_path' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'test' . DIRECTORY_SEPARATOR,
        ],
    ],
    'production' => [
        'url' => 'https://missurgicals.techneyo.com',
        'upload_directories' => [
            'category' => [
                'image' => DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'categories' . DIRECTORY_SEPARATOR,
                'image_path' => dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'themagicalvastu.com' . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . '' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'categories' . DIRECTORY_SEPARATOR,
            ],
            'product' => [
                'image' => DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR,
                'image_path' => dirname(__DIR__ , 2) . DIRECTORY_SEPARATOR . 'themagicalvastu.com' . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . '' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR,
            ],
            'test' => [
                'image' => DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR,
                'image_path' => dirname(__DIR__ , 2) . DIRECTORY_SEPARATOR . 'themagicalvastu.com' . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . '' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR,
            ],
        ],
    ],
];
