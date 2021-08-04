<?php
return [
    'prefix' => [
        'admin' => 'admin',
    ],
    'path' => [
        'assets' => '/assets'
    ],
    'template' => [
        'user' => [
            'filter' => [
                'status' => [
                    'active' => [
                        'content' => 'Active',
                        'class' => 'btn btn-success',
                    ],
                    'inactive' => [
                        'content' => 'In Active',
                        'class' => 'btn btn-warning',
                    ],
                ]
            ],
        ],
    ],
    'form' => [
        'input' => [
            'text' => [
            ]
        ]
    ]
];
