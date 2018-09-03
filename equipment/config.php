<?php
return [
    'title' => 'مدیریت تجهیزات',
    'menu' => [
        'label' => 'مدیریت تجهیزات',
        'icon' => 'cogs',
        'items' => [
            [
                'label' => 'انواع تجهیزات',
                'url' => ['/equipment/type/manage/index'],
                'visible' => Yii::$app->user->can('equipment.type')
            ],
            [
                'label' => 'رده های تجهیزات',
                'url' => ['/equipment/type/category/index'],
                'visible' => Yii::$app->user->can('equipment.type')
            ],
        ]
    ]
];
