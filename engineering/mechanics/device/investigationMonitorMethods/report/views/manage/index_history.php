<?php

$this->title = 'لیست داده گاه روندهای گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/mechanics/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/mechanics/device/manage/investigation-monitor-methods']],
    'داده گاه روندهای گزارش',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/engineering/mechanics/device/investigationMonitorMethods/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/engineering/mechanics/device/investigationMonitorMethods/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/engineering/mechanics/device/investigationMonitorMethods/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/mechanics/device/investigationMonitorMethods/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
