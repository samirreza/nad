<?php

$this->title = 'لیست داده گاه منشا';
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مراحل', 'url' => ['/engineering/construction/stage/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/construction/stage/manage/investigation-monitor-methods']],
    'داده گاه منشا',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/engineering/construction/stage/investigationMonitorMethods/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/engineering/construction/stage/investigationMonitorMethods/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/engineering/construction/stage/investigationMonitorMethods/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/construction/stage/investigationMonitorMethods/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
