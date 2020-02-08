<?php

$this->title = 'لیست داده گاه روندهای گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/electricity/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/electricity/device/manage/investigation-improvement']],
    'داده گاه روندهای گزارش',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/engineering/electricity/device/investigationImprovement/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/engineering/electricity/device/investigationImprovement/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/engineering/electricity/device/investigationImprovement/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/electricity/device/investigationImprovement/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
