<?php

$this->title = 'لیست داده گاه دستورالعمل';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/geotechnics/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/geotechnics/device/manage/investigation-monitor-methods']],
    'داده گاه دستورالعمل',
    $this->title
];
$this->params['horizontalMenuItems'] = [
    [
        'label' => 'برنامه دستورالعمل',
        'url' => ['/engineering/geotechnics/device/investigationMonitorMethods/instruction/manage/index']
    ],
    [
        'label' => 'داده گاه دستورالعمل',
        'url' => ['/engineering/geotechnics/device/investigationMonitorMethods/instruction/manage/archived-index']
    ],
    [
        'label' => 'داده گاه روند دستورالعمل',
        'url' => ['/engineering/geotechnics/device/investigationMonitorMethods/instruction/manage/index-history']
    ],
    [
        'label' => 'داده گاه منابع',
        'url' => ['/engineering/geotechnics/device/investigationMonitorMethods/reference/manage/index']
    ]
];

?>

<?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/index_archived', [
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]);
