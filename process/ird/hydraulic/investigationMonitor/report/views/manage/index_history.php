<?php

$this->title = 'لیست داده گاه روندهای گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'هیدرولیک', 'url' => ['/hydraulic/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/hydraulic/manage/investigation-monitor']],
    'داده گاه روندهای گزارش',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/hydraulic/investigationMonitor/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/hydraulic/investigationMonitor/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/hydraulic/investigationMonitor/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/hydraulic/investigationMonitor/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
