<?php
return [
    'mail' => [
        'name' => 'BOOK SHOP',
        'username' => 'peteranh99.test@gmail.com',
    ],
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
            'pending' => [
                'content' => 'Pending Payment',
                'class' => 'btn btn-info',
            ],
            'processing' => [
                'content' => 'Processing',
                'class' => 'btn btn-warning',
            ],
            'shipped' => [
                'content' => 'Shipped',
                'class' => 'btn btn-light',
            ],
            'on_hold' => [
                'content' => 'On Hold',
                'class' => 'btn btn-danger',
            ],
            'completed' => [
                'content' => 'Completed',
                'class' => 'btn btn-success',
            ],
            'refunded' => [
                'content' => 'Refunded',
                'class' => 'btn btn-dark',
            ],
            'canceled' => [
                'content' => 'Canceled',
                'class' => 'btn btn-light',
            ],
            'failed' => [
                'content' => 'Failed',
                'class' => 'btn btn-light',
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

            // book
            'title' => 'Search by title',

        ],
        'shipping_method' => [
            'saving' => [
                'content' => 'Saving',
            ],
            'fast' => [
                'content' => 'Fast',
            ],
            'express' => [
                'content' => 'Express',
            ],
        ],
        'payment_method' => [
            'cod' => [
                'content' => 'COD',
            ],
            'transfer' => [
                'content' => 'Transfer',
            ],
        ],
    ],
    'controller' => [
        'user' => [
            'status' => ['all', 'active', 'inactive'],
            'action' => ['view', 'edit', 'delete'],
            'filter' => ['status', 'group_id'],
            'sort'   => ['username', 'email', 'group_id', 'status', 'created_at'],
            'search' => ['all', 'username', 'email'],
        ],
        'category' => [
            'status' => ['all', 'active', 'inactive'],
            'action' => ['edit', 'delete'],
            'filter' => ['status'],
            'sort'   => ['name', 'slug', 'status', 'created_at'],
            'search' => ['all', 'name'],
        ],
        'book' => [
            'status' => ['all', 'active', 'inactive'],
            'action' => ['edit', 'delete'],
            'filter' => ['status', 'author_id', 'category_id'],
            'sort'   => ['title', 'slug', 'author_id', 'category_id', 'price', 'status', 'created_at'],
            'search' => ['all', 'title'],
        ],
        'group' => [
            'status' => ['all', 'active', 'inactive'],
            'action' => ['edit', 'delete'],
            'filter' => ['status'],
            'sort'   => ['name', 'status', 'created_at'],
            'search' => ['all', 'name'],
        ],
        'order' => [
            'status' => ['all', 'pending', 'processing', 'shipped', 'on_hold', 'completed',  'canceled', 'refunded', 'failed'],
            'payment_method' => ['all', 'cod', 'transfer'],
            'shipping_method' => ['all', 'saving', 'fast', 'express'],
            'action' => ['view', 'delete'],
            'filter' => ['status', 'shipping_method', 'payment_method'],
            'sort'   => ['status', 'created_at'],
            'search' => ['all'],
        ],
    ],
];
