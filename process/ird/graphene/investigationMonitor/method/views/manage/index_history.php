<?php

$this->title = 'لیست داده گاه روندهای روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'گرافن', 'url' => ['/graphene/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/graphene/manage/investigation-monitor']],
    'داده گاه روندهای روش',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/graphene/investigationMonitor/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/graphene/investigationMonitor/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/graphene/investigationMonitor/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/graphene/investigationMonitor/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
