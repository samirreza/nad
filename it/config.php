<?php
return [
    'title' => 'دپارتمان آی تی',
    'menu' => [
        'label' => 'دپارتمان آی تی',
        'icon' => 'desktop',
        'items' => [
            [
                'label' => 'مدیریت تجهیزات',
                'visible' => Yii::$app->user->can('it.equipment-type'),
                'items' => [
                    [
                        'label' => 'انواع تجهیزات',
                        'url' => ['/it/equipment/type/manage/index']
                    ],
                    [
                        'label' => 'رده های تجهیزات',
                        'url' => ['/it/equipment/type/category/index']
                    ],
                ]
            ]
        ]
    ]
];
