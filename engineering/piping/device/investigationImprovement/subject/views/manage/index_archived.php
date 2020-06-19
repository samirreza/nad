<?php

$this->title = 'لیست داده گاه موضوع';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/piping/device/manage/investigation-improvement']],
    'داده گاه موضوع',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/engineering/piping/device/investigationImprovement/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/engineering/piping/device/investigationImprovement/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/piping/device/investigationImprovement/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
