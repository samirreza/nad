<?php
return [
    'title' => 'مدیریت مواد',
    'menu' => [
        'label' => 'مدیریت مواد',
        'icon' => 'flask',
        'items' => [
            [
                'label' => 'انواع مواد',
                'url' => ['/material/type/manage/index'],
                'visible' => Yii::$app->user->can('material.type')
            ],
            [
                'label' => 'رده های مواد',
                'url' => ['/material/type/category/index'],
                'visible' => Yii::$app->user->can('material.type')
            ],
        ]
    ]
];
