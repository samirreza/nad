<?php

$this->title = 'لیست داده گاه روش';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/control/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/control/device/manage/investigation-improvement']],
    'داده گاه روش',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/engineering/control/device/investigationImprovement/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/engineering/control/device/investigationImprovement/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/engineering/control/device/investigationImprovement/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/control/device/investigationImprovement/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
