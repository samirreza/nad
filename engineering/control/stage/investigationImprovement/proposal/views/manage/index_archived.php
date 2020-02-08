<?php

$this->title = 'لیست داده گاه پروپوزال';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'مراحل', 'url' => ['/engineering/control/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/control/stage/manage/investigation-improvement']],
    'داده گاه پروپوزال',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه پروپوزال',
        'url' => ['/engineering/control/stage/investigationImprovement/proposal/manage/index']
    ],
    [
        'label' => 'داده گاه پروپوزال',
        'url' => ['/engineering/control/stage/investigationImprovement/proposal/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند پروپوزال',
        'url' => ['/engineering/control/stage/investigationImprovement/proposal/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/control/stage/investigationImprovement/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
