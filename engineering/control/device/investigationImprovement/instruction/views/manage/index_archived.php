<?php

$this->title = 'لیست داده گاه دستورالعمل';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/control/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/control/device/manage/investigation-improvement']],
    'داده گاه دستورالعمل',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/engineering/control/device/investigationImprovement/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/engineering/control/device/investigationImprovement/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/engineering/control/device/investigationImprovement/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/control/device/investigationImprovement/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
