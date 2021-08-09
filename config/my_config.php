<?php
return [
    'prefix' => [
        'admin' => 'admin',
    ],
    'path' => [
        'assets'    => '/assets',
        'storage'   => '/storage'
    ],
    'template' => [
        'status' => [
            'all' => [
                'content' => 'All',
                'class' => 'btn btn-success',
            ],
            'active' => [
                'content' => 'Active',
                'class' => 'btn btn-success',
            ],
            'inactive' => [
                'content' => 'In Active',
                'class' => 'btn btn-warning',
            ],
        ],
        'action' => [
            'view' => [
                'icon' => 'fas fa-info fa-fw',
                'class' => 'btn btn-info btn-sm',
                'route' => 'show',
                'content' => 'View',
            ],
            'edit' => [
                'icon' => 'fas fa-edit fa-fw',
                'class' => 'btn btn-success btn-sm',
                'route' => 'edit',
                'content' => 'Edit',
            ],
            'delete' => [
                'icon' => 'fas fa-trash-alt fa-fw',
                'class' => 'btn btn-danger btn-sm',
                'route' => 'delete',
                'content' => 'Delete',
            ],
        ],
        'search' => [
            // COMMON
            'all' => 'Search by all',
            'name' => 'Search by name',

            // USER
            'email' => 'Search by email',
            'username' => 'Search by username',

            //
        ]
    ],
    'controller' => [
        'user' => [
            'status' => ['all', 'active', 'inactive'],
            'action' => ['view', 'edit', 'delete'],
            'filter' => ['status', 'group_id'],
            'sort'   => ['username', 'email', 'status', 'created_at'],
            'search' => ['all', 'username', 'email'],
        ],
    ],
];
