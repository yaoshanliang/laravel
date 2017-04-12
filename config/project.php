<?php

return [

    // 项目配置
    'name' => 'xxx',
    'web_name' => '',
    'admin_name' => '管理后台',

    // 后台相关
    'admin' => [

        // 系统配置
        'system' => [
            'log' => true,
        ],

        // 是否开启权限(true: 开启; false: 不开启,拥有全部权限)
        'permission_open' => 'true',

        // 权限列表
        'permissions' => [
            '管理员模块' => [
                '创建管理员' => 'createAdminAccount',
                '修改管理员' => 'updateAdminAccount',
                '删除管理员' => 'deleteAdminAccount',
            ],
        ],
    ],

    // api相关
    'api' => [

    ],

];