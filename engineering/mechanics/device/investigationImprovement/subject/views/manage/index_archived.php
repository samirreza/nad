<?php

$this->title = 'لیست داده گاه موضوع';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'مراحل', 'url' => ['/engineering/mechanics/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/mechanics/device/manage/investigation-improvement']],
    'داده گاه موضوع',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه موضوع',
        'url' => ['/engineering/mechanics/device/investigationImprovement/subject/manage/index']
    ],
    [
        'label' => 'داده گاه موضوع',
        'url' => ['/engineering/mechanics/device/investigationImprovement/subject/manage/archived-index']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/mechanics/device/investigationImprovement/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/subject/views/subject/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
