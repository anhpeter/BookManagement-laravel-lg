<?php
return [
    'prefix' => [
        'admin' => 'admin',
    ],
    'path' => [
        'assets' => '/assets'
    ],
    'template' => [
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
        'select' => [
            'status' => ['active', 'inactive'],
        ]
    ],
    'form' => [
        'label'             => 'col-lg-2 col-form-label',
        'input-container'   => 'col-lg-10',
        'submit-container'  => 'offset-lg-2 d-flex justify-content-end col-md-10',
        'input'     => [
            'text'      => 'form-control',
            'select'    => 'custom-select'
        ]
    ]
];