<?php

$this->title = 'لیست داده گاه روش';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/instrument/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/instrument/device/manage/investigation-monitor-methods']],
    'داده گاه روش',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/engineering/instrument/device/investigationMonitorMethods/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/engineering/instrument/device/investigationMonitorMethods/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/engineering/instrument/device/investigationMonitorMethods/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/instrument/device/investigationMonitorMethods/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
