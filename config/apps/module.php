<?php

return [
    'module' => [
        [
            'title' => 'QL thành viên',
            'icon' => 'fa fa-th-large',
            'name' => ['user', 'user-catalogue'],
            'subModule' => [
                [
                    'title' => 'QL thành viên',
                    'route' => 'user',
                    'name'  => 'user'
                ],
                [
                    'title' => 'QL nhóm thành viên',
                    'route' => 'user.catalogue',
                    'name'  => 'user-catalogue'
                ],
            ]
        ],
        [
            'title' => 'QL bài viết',
            'icon' => 'fa fa-file',
            'name' => ['post', 'post-catalogue'],
            'subModule' => [
                [
                    'title' => 'QL nhóm bài viết',
                    'route' => 'post-catalogue',
                    'name'  => 'post-catalogue'
                ],
                [
                    'title' => 'QL bài viết',
                    'route' => 'post',
                    'name'  => 'post'
                ]

            ]
        ],
        [
            'title' => 'Cấu hình chung',
            'icon' => 'fa fa-file',
            'name' => ['language'],
            'subModule' => [
                [
                    'title' => 'QL ngôn ngữ',
                    'route' => 'language',
                    'name' => 'language',
                ],
            ]
        ],
    ],

];
