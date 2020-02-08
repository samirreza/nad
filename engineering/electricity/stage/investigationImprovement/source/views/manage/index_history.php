<?php

$this->title = 'لیست داده گاه روندهای منشا';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'مراحل', 'url' => ['/engineering/electricity/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/electricity/stage/manage/investigation-improvement']],
    'داده گاه روندهای منشا',
    $this->title
];

$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه منشا',
        'url' => ['/engineering/electricity/stage/investigationImprovement/source/manage/index']
    ],
    [
        'label' => 'داده گاه منشا',
        'url' => ['/engineering/electricity/stage/investigationImprovement/source/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند منشا',
        'url' => ['/engineering/electricity/stage/investigationImprovement/source/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/electricity/stage/investigationImprovement/reference/manage/index']
    ]
];
?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/index_history', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
