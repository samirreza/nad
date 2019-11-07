<?php

$this->title = 'لیست داده گاه روندهای گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'کارتریج', 'url' => ['/cartridge/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/cartridge/manage/investigation-monitor']],
    'داده گاه روندهای گزارش',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/cartridge/investigationMonitor/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/cartridge/investigationMonitor/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/cartridge/investigationMonitor/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/cartridge/investigationMonitor/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
