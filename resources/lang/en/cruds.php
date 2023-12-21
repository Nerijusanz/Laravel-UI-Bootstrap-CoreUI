<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields' => [
            'id'                => 'ID',
            'title'             => 'Title',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
        'messages' => [
            'updated' => 'updated'
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields' => [
            'id'                 => 'ID',
            'title'              => 'Title',
            'permissions'        => 'Permissions',
            'created_at'         => 'Created at',
            'updated_at'         => 'Updated at',
            'deleted_at'         => 'Deleted at',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields' => [
            'id'                       => 'ID',
            'name'                     => 'Name',
            'email'                    => 'Email',
            'email_verified_at'        => 'Email verified at',
            'password'                 => 'Password',
            'password_confirmation'    => 'Password confirmation',
            'role'                  => 'Role',
            'no_role'               => 'No role',
            'remember_token'           => 'Remember Token',
            'created_at'               => 'Created at',
            'updated_at'               => 'Updated at',
            'deleted_at'               => 'Deleted at',
        ],
        'messages' => [
            'updated' => 'updated'
        ],
    ],
];
