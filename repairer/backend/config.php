<?php

$user = Yii::$app->user;
$label = 'مدیریت تعمیرکاران';
$icon = 'user-md';

return [
    'title' => 'ماژول تعمیرکاران',
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
                'label' => 'افزودن تعمیرکار',
                'url' => ['/repairer/manage/create'],
                'visible' => $user->canAccessAny(['repairer.create'])
            ],
            [
                'label' => 'لیست تعمیرکاران',
                'url' => ['/repairer/manage/index'],
                'visible' => $user->canAccessAny(['repairer.create', 'repairer.delete', 'repairer.update'])
            ]
        ]
    ]
];