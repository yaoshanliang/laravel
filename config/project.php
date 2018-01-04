<?php

return [

    // 项目配置
    'name' => 'xxx',
    'web_name' => '',
    'admin_name' => '管理后台',

    // 后台相关
    'admin' => [

        // 是否记录日志
        'log' => true,

        // 角色
        'roles' => [
            0 => '超级管理员',
            // 1 => '普通管理员'
        ]

    ],

    // web相关
    'web' => [

        // 是否记录日志
        'log' => true

    ],

    // api相关
    'api' => [

        // 是否记录日志
        'log' => true,

        // token有效时长
        'token_expires_in' => 60 * 60 * 24 * 10,
    ],

];