<?php

$user = Yii::$app->user;
$label = 'مدیریت تامین کنندگان';
$icon = 'users';

return [
    'title' => 'ماژول تامین کنندگان',
    'components' => [
        // list of component configurations
    ],
    'params' => [
        // list of parameters
    ],
    'menu' => [
        'label' => $label,
        'icon' => $icon,
        'items' => [
            [
                'label' => 'افزودن تامین کننده',
                'url' => ['/supplier/manage/create'],
                'visible' => $user->canAccessAny(['supplier.create'])
            ],
            [
                'label' => 'لیست تامین کنندگان',
                'url' => ['/supplier/manage/index'],
                'visible' => $user->canAccessAny(['supplier.create', 'supplier.delete', 'supplier.update'])
            ]
        ]
    ]
];