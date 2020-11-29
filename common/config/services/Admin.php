<?php

return [
    'admin' => [
        'class' => 'services\Admin',
        // 子服务
        'childService' => [
            'menu' => [
                'class'        => 'services\admin\Menu',

            ],
        ],
    ]
];