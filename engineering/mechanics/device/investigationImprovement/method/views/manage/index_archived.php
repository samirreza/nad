<?php

$this->title = 'لیست داده گاه روش';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/mechanics/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/mechanics/device/manage/investigation-improvement']],
    'داده گاه روش',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/engineering/mechanics/device/investigationImprovement/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/engineering/mechanics/device/investigationImprovement/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/engineering/mechanics/device/investigationImprovement/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/mechanics/device/investigationImprovement/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
