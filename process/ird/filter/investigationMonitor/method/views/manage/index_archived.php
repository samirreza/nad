<?php

$this->title = 'لیست داده گاه روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'فیلترشنی', 'url' => ['/filter/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/filter/manage/investigation-monitor']],
    'داده گاه روش',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/filter/investigationMonitor/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/filter/investigationMonitor/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/filter/investigationMonitor/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/filter/investigationMonitor/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
