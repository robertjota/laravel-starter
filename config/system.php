<?php

return [
    'app' => [
        'name' => env('APP_NAME', 'Laravel Starter'),
        'version' => '2.0.0',
    ],

    'pagination' => [
        'default' => 10,
        'options' => [10, 25, 50, 100],
    ],

    'roles' => [
        'super_admin' => 'Super Admin',
        'admin' => 'Admin',
        'user' => 'Usuario',
    ],

    'permissions' => [
        'users' => [
            'index' => 'admin.users.index',
            'show' => 'admin.users.show',
            'create' => 'admin.users.create',
            'edit' => 'admin.users.edit',
            'destroy' => 'admin.users.destroy',
            'asignar' => 'admin.users.asignar',
        ],
        'roles' => [
            'index' => 'admin.roles.index',
            'show' => 'admin.roles.show',
            'create' => 'admin.roles.create',
            'edit' => 'admin.roles.edit',
            'destroy' => 'admin.roles.destroy',
        ],
        'permissions' => [
            'index' => 'admin.permissions.index',
            'show' => 'admin.permissions.show',
            'create' => 'admin.permissions.create',
            'edit' => 'admin.permissions.edit',
            'destroy' => 'admin.permissions.destroy',
        ],
    ],

    'upload' => [
        'max_size' => 2048,
        'allowed_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'],
    ],
];
