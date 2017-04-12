<?php

return [
    'name' => 'xxx',
    'web_name' => '',
    'admin_name' => '管理后台',

    'system' => [
        'log' => true,
    ],

    'permissions' => [
        'admin' => [
            '管理员模块' => [
                '创建管理员' => 'createAdminAccount',
                '修改管理员' => 'updateAdminAccount',
                '删除管理员' => 'deleteAdminAccount',

            ]
        ]
    ],
];