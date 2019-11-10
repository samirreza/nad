<?php

$this->title = 'لیست داده گاه روندهای روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آر او', 'url' => ['/ro/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/ro/manage/investigation-monitor']],
    'داده گاه روندهای روش',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/ro/investigationMonitor/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/ro/investigationMonitor/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/ro/investigationMonitor/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/ro/investigationMonitor/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);