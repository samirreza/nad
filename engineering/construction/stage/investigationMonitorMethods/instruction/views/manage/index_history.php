<?php

$this->title = 'لیست داده گاه روندهای دستورالعمل';
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مراحل', 'url' => ['/engineering/construction/stage/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/construction/stage/manage/investigation-monitor-methods']],
    'داده گاه روندهای دستورالعمل',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/engineering/construction/stage/investigationMonitorMethods/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/engineering/construction/stage/investigationMonitorMethods/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/engineering/construction/stage/investigationMonitorMethods/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/construction/stage/investigationMonitorMethods/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
