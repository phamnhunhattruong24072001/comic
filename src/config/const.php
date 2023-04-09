<?php
return [
    'admin' => [
        'status' => [
            'active' => 1,
            'deactivate' => 0,
        ],
        'role' => [
            'admin' => 'admin',
            'user' => 'user',
        ],
    ],
    'system' => [
        'language' => [
            'vi' => 'vi',
            'en' => 'en',
        ],
    ],
    'activate' => [
        'on' => 1,
        'off' => 0,
    ],
    'gender' => [
        'male' => 1,
        'female' => 2,
    ],
    'image' => [
        'imageNull' => 'global/image-null.png',
    ],
    'path' => [
        'user' => 'public/users',
        'country' => 'public/countries',
        'comic' => 'public/comics',
        'chapter' => 'public/chapters',
        'figure' => 'public/figures',
    ],
    'category' => [
        'parent' => 0,
    ],
    'genre' => [
        'highlight' => 1,
    ],
    'comic' => [
        'highlight' => 1,
        'type_image' => 'image',
        'type_text' => 'text',
        'status' => [
            'not_released' => 0,
            'waiting_for_release' => 1,
            'release' => 2,
            'pause' => 3,
        ]
    ],
    'slug_chapter' => 'chapter-',
];
