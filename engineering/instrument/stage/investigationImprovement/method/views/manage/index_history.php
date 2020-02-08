<?php

$this->title = 'لیست داده گاه روندهای روش';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'مراحل', 'url' => ['/engineering/instrument/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/instrument/stage/manage/investigation-improvement']],
    'داده گاه روندهای روش',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه روش',
        'url' => ['/engineering/instrument/stage/investigationImprovement/method/manage/index']
    ],
    [
        'label' => 'داده گاه روش',
        'url' => ['/engineering/instrument/stage/investigationImprovement/method/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند روش',
        'url' => ['/engineering/instrument/stage/investigationImprovement/method/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/instrument/stage/investigationImprovement/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
