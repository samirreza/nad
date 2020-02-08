<?php

$this->title = 'لیست داده گاه گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'مراحل', 'url' => ['/engineering/electricity/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/electricity/stage/manage/investigation-improvement']],
    'داده گاه گزارش',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه گزارش',
        'url' => ['/engineering/electricity/stage/investigationImprovement/report/manage/index']
    ],
    [
        'label' => 'داده گاه گزارش',
        'url' => ['/engineering/electricity/stage/investigationImprovement/report/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند گزارش',
        'url' => ['/engineering/electricity/stage/investigationImprovement/report/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/electricity/stage/investigationImprovement/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/report/views/report/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
