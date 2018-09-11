<?php

$user = Yii::$app->user;
$label = 'مدیریت سازندگان';
$icon = 'wrench';

return [
    'title' => 'ماژول سازندگان',
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
                'label' => 'افزودن سازنده',
                'url' => ['/maker/manage/create'],
                'visible' => $user->canAccessAny(['maker.create'])
            ],
            [
                'label' => 'لیست سازندگان',
                'url' => ['/maker/manage/index'],
                'visible' => $user->canAccessAny(['maker.create', 'maker.delete', 'maker.update'])
            ]
        ]
    ]
];